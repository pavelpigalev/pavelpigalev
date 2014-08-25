<?php

class FrontHelper
{
    private $_js = array();
    private $_less = array();
    private $_metaTags = array();
    private $_ogTags = array();

    private $_firstLess = 'layout/first.less';

    private $_srcDir = '/front/';
    private $_cssDir = '/assets/css/';
    private $_jsDir = '/assets/js/';

    private $_version = null;

    private $_app;
    private $_appParams;
    private $_appWebRoot;

    private static $_o;

    private function __construct()
    {
        $this->_app = Yii::app();
        $this->_appParams = $this->_app->params;
        $this->_appWebRoot = $this->_appParams['webRoot'];
        
        // Создадим папки для хранения скомпилированных файлов
        if (!file_exists($this->_appWebRoot . $this->_cssDir)) {
            mkdir($this->_appWebRoot . $this->_cssDir, 0777, true);
            chmod($this->_appWebRoot . $this->_cssDir, 0777);
        }

        if (!file_exists($this->_appWebRoot . $this->_jsDir)) {
            mkdir($this->_appWebRoot . $this->_jsDir, 0777, true);
            chmod($this->_appWebRoot . $this->_jsDir, 0777);
        }
    }

    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    /**
     *
     * @return FrontHelper
     */
    public static function o()
    {
        if (is_null(self::$_o)) {
            self::$_o = new self;
        }

        return self::$_o;
    }

    public function addJs($filePath)
    {
        if(!empty($filePath) && strpos($filePath, '.') === false) {
            $filePath .= '.js';
        }
        if (!in_array($filePath, $this->_js)) {
            $this->_js[] = $filePath;
        }

        return $this;
    }

    public function addLess($filePath)
    {
        if(!empty($filePath) && strpos($filePath, '.') === false) {
            $filePath .= '.less';
        }
        if (!in_array($filePath, $this->_less) && $filePath != $this->_firstLess) {
            $this->_less[] = $filePath;
        }

        return $this;
    }

    /**
     * @param $tag
     * @param $content
     * @return $this
     */
    public function addMetaTag($tag, $content)
    {
        $this->_metaTags[$tag] = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getMetaTags()
    {
        if (!empty($this->_metaTags['keywords'])) {
            $this->_metaTags['keywords'] = trim(preg_replace('/[\s,\.;\-#:\'"{}&*()@!?$%^<>+]+/', ' ', $this->_metaTags['keywords']));
            $this->_metaTags['keywords'] = str_replace(' ', ', ', $this->_metaTags['keywords']);
        }

        return $this->_metaTags;
    }

    /**
     * @param $tag
     * @param $content
     * @return $this
     */
    public function addOgTag($tag, $content)
    {
        $this->_ogTags[$tag] = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getOgTags()
    {
        return $this->_ogTags;
    }

    /**
     * @return string
     */
    public function getCssFile()
    {
        if (empty($this->_less)) {
            return false;
        }

        sort($this->_less);

        $resultFilename = 'style-' . md5(json_encode($this->_less)) . '.css';

        $this->_less = array_merge(array($this->_firstLess), $this->_less);

        if (file_exists($this->_appWebRoot . $this->_cssDir . $resultFilename) && !$this->_appParams['debug']) {
            return $this->_cssDir . $resultFilename . '?' . $this->_getVersion();
        }

        $less = new lessc();

        if ($this->_appParams['debug']) {
            $less->setPreserveComments(true);
        } else {
            $less->setFormatter('compressed');
        }

        $cssCode = '';
        foreach ($this->_less as $file) {
            $cssCode .= $less->compileFile($this->_appWebRoot . $this->_srcDir . 'less/' . $file) . PHP_EOL;
        }

        $cssFile = fopen($this->_appWebRoot . $this->_cssDir . $resultFilename, 'w+');
        fputs($cssFile, $cssCode);
        fclose($cssFile);

        return $this->_cssDir . $resultFilename . '?' . $this->_getVersion();
    }

    public function getJsFile()
    {
        return $this->_makeJs($this->_js);
    }

    /**
     * @param array $files
     * @return bool|string
     */
    private function _makeJs($files = array())
    {
        if (empty($files)) {
            return false;
        }

        $resultFilename = 'script-' . md5(json_encode($files)) . '.js';

        if (file_exists($this->_appWebRoot . $this->_jsDir . $resultFilename) && !$this->_appParams['debug']) {
            return $this->_jsDir . $resultFilename . '?' . $this->_getVersion();
        }

        $errors = array();
        $jsCode = '// Built ' . date('Y-m-d H:i:s') . PHP_EOL;
        foreach ($files as $file) {
            $filePath = $this->_appWebRoot . $this->_srcDir . 'js/' . $file;

            if (!file_exists($filePath)) {
                $errors[] = $file . ' not found!';
            } else {
                $jsCode .= '// ' . $file . PHP_EOL . file_get_contents($filePath) . PHP_EOL . PHP_EOL;
            }
        }

        if (!empty($errors)) {
            $errorComment = '// Errors: ' . PHP_EOL;

            foreach ($errors as $error) {
                $errorComment .= '// ' . $error . PHP_EOL;
            }

            $jsCode = $errorComment . PHP_EOL . $jsCode;
        }

        $jsFile = fopen($this->_appWebRoot . $this->_jsDir . $resultFilename, 'w+');
        fputs($jsFile, $jsCode);
        fclose($jsFile);

        return $this->_jsDir . $resultFilename . '?' . $this->_getVersion();
    }

    private function _getVersion()
    {
        if (is_null($this->_version)) {
            $projectDir = realpath($this->_appWebRoot . '/../');

            $ver = false;
            if (preg_match('/^ref: (.+)$/', file_get_contents($projectDir . '/.git/HEAD'), $m)) {
                if (file_exists($projectDir . '/.git/' . $m[1])) {
                    $ver = file_get_contents($projectDir . '/.git/' . $m[1]);
                }
            }
            if (!$ver) {
                $ver = file_get_contents($projectDir . '/.git/ORIG_HEAD');
            }

            $this->_version = $ver;
        }

        return trim($this->_version);
    }
}