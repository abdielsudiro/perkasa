<?php

namespace PHPMaker2021\perkasa2;

/**
 * CAPTCHA class
 */
class PhpCaptcha extends CaptchaBase
{
    public static $BackgroundColor = "FFFFFF"; // Hex string
    public static $TextColor = "003359"; // Hex string
    public static $NoiseColor = "64A0C8"; // Hex string
    public static $Width = 200;
    public static $Height = 50;
    public static $Characters = 6;
    public static $FontSize = 0;
    public static $ImageType = IMG_PNG;
    public static $Font = "aftershock";
    public $Response = "";
    public $ResponseField = "captcha";

    /**
     * Constructor
     *
     * @param string $Font Font file name
     */
    public function __construct()
    {
        if (self::$FontSize <= 0) {
            self::$FontSize = self::$Height * 0.55;
        }
    }

    /**
     * Generate code
     *
     * @param int $Characters Number of characters
     * @return string
     */
    protected function generateCode($Characters)
    {
        $possible = "23456789BCDFGHJKMNPQRSTVWXYZ"; // Possible characters
        $code = "";
        $i = 0;
        while ($i < $Characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $i++;
        }
        return $code;
    }

    /**
     * Convert hex to RGB
     *
     * @param string $hexstr Hex string
     * @return array Array of RGB
     */
    protected function hexToRGB($hexstr)
    {
        $int = hexdec($hexstr);
        return [
            "R" => 0xFF & ($int >> 0x10),
            "G" => 0xFF & ($int >> 0x8),
            "B" => 0xFF & $int
        ];
    }

    /**
     * Output image
     *
     * @return string Code
     */
    public function show()
    {
        $code = $this->generateCode(self::$Characters);
        $oriCode = $code;
        $code = "";
        $len = strlen($oriCode);
        for ($i = 0; $i < $len; $i++) {
            $code .= $oriCode[$i];
            if ($i < $len - 1) {
                $code .= " ";
            }
        }
        $code = trim($code);
        try {
            $image = imagecreate(self::$Width, self::$Height);
        } catch (\Exception $e) {
            throw new \Exception("PhpCaptcha: Cannot initialize new GD image stream - " . $e->getMessage());
        }
        $rgb = $this->hexToRGB(self::$BackgroundColor);
        $backgroundColor = imagecolorallocate($image, $rgb["R"], $rgb["G"], $rgb["B"]);
        $rgb = $this->hexToRGB(self::$TextColor);
        $textColor = imagecolorallocate($image, $rgb["R"], $rgb["G"], $rgb["B"]);
        $rgb = $this->hexToRGB(self::$NoiseColor);
        $noiseColor = imagecolorallocate($image, $rgb["R"], $rgb["G"], $rgb["B"]);
        // Generate random dots in background
        for ($i = 0; $i < (self::$Width * self::$Height) / 3; $i++) {
            imagefilledellipse($image, mt_rand(0, self::$Width), mt_rand(0, self::$Height), 1, 1, $noiseColor);
        }
        // Generate random lines in background
        for ($i = 0; $i < (self::$Width * self::$Height) / 150; $i++) {
            imageline($image, mt_rand(0, self::$Width), mt_rand(0, self::$Height), mt_rand(0, self::$Width), mt_rand(0, self::$Height), $noiseColor);
        }
        $fontFile = self::$Font;
        // Always use full path
        if (!ContainsString($fontFile, ".")) {
            $fontFile .= ".ttf";
        }
        $fontFile = IncludeTrailingDelimiter(Config("FONT_PATH"), true) . $fontFile;
        // Create textbox and add text
        try {
            $textBox = imagettfbbox(self::$FontSize, 0, $fontFile, $code);
        } catch (\Exception $e) {
            throw new \Exception("PhpCaptcha: Error in imagettfbbox function - " . $e->getMessage());
        }
        $x = (self::$Width - $textBox[4]) / 2;
        $y = (self::$Height - ($textBox[5] - $textBox[3])) / 2;
        try {
            imagettftext($image, self::$FontSize, 0, $x, $y, $textColor, $fontFile, $code);
        } catch (\Exception $e) {
            throw new \Exception("PhpCaptcha: Error in imagettfbbox function - " . $e->getMessage());
        }
        // Output captcha image to browser
        if (ob_get_length()) { // Clean buffer
            ob_end_clean();
        }
        ob_start();
        switch (self::$ImageType) {
            case IMG_JPG:
                AddHeader("Content-Type", "image/jpeg");
                imagejpeg($image, null, 90);
                break;
            case IMG_GIF:
                AddHeader("Content-Type", "image/gif");
                imagegif($image);
                break;
            default: // PNG
                AddHeader("Content-Type", "image/png");
                imagepng($image);
                break;
        }
        $data = ob_get_contents();
        ob_end_clean();
        Write($data);
        imagedestroy($image);
        return $oriCode;
    }

    // HTML tag
    public function getHtml()
    {
        global $Language, $Page;
        $classAttr = ($Page->OffsetColumnClass) ? ' class="' . $Page->OffsetColumnClass . '"' : "";
        $class = $this->getFailureMessage() != "" ? " is-invalid" : "";
        $url = GetUrl("captcha/" . $Page->PageID);
        return <<<EOT
<div class="form-group row ew-captcha">
    <div{$classAttr}>
        <p><img src="{$url}" alt="" class="ew-captcha-image"></p>
        <input type="text" name="{$this->getElementName()}" id="{$this->getElementId()}" class="form-control ew-control{$class}" size="30" placeholder="{$Language->phrase("EnterValidateCode")}">
        <div class="invalid-feedback">{$this->getFailureMessage()}</div>
    </div>
</div>
EOT;
    }

    // HTML tag for confirm page
    public function getConfirmHtml()
    {
        return '<input type="hidden" name="' . $this->getElementName() . '" id="' . $this->getElementId() . '" value="' . HtmlEncode($this->Response) . '">';
    }

    // Validate
    public function validate()
    {
        $sessionName = $this->getSessionName();
        return ($this->Response == Session($sessionName));
    }

    // Client side validation script
    public function getScript($formName)
    {
        return $formName . '.addField("' . $this->getElementName() . '", ew.Validators.captcha, ' . ($this->getFailureMessage() != '' ? 'true' : 'false') . ');';
    }
}
