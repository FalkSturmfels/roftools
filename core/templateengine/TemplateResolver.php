<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemplateResolver
 *
 * @author Achim
 */
class TemplateResolver
{

    /**
     * Template directory
     */
    private $templateDir = "../templates/";

    /**
     * Language bundles directory
     */
    private $languageDir = "language/";

    /**
     * Der linke Delimter für einen Standard-Platzhalter.
     */
    private $leftDelimiter = '{$';

    /**
     * Der rechte Delimter für einen Standard-Platzhalter.
     */
    private $rightDelimiter = '}';

    /**
     * Der linke Delimter für eine Funktion.
     */
    private $leftDelimiterF = '{';

    /**
     * Der rechte Delimter für eine Funktion.
     */
    private $rightDelimiterF = '}';

    /**
     * Der linke Delimter für ein Kommentar.
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $leftDelimiterC = '\{\*';

    /**
     * Der rechte Delimter für ein Kommentar.
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $rightDelimiterC = '\*\}';

    /**
     * Der linke Delimter für eine Sprachvariable
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $leftDelimiterL = '\{L_';

    /**
     * Der rechte Delimter für eine Sprachvariable
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $rightDelimiterL = '\}';

    /**
     * Der komplette Pfad der Templatedatei.
     */
    private $templateFile = "";

    /**
     * Der komplette Pfad der Sprachdatei.
     */
    private $languageFile = "";

    /**
     * Der Dateiname der Templatedatei.
     */
    private $templateName = "";

    /**
     * Der Inhalt des Templates.
     */
    private $template = "";

    public function __construct($tpl_dir = "", $lang_dir = "")
    {

        if (!empty($tpl_dir))
        {
            $this->templateDir = $tpl_dir;
        }

        if (!$lang_dir)
        {
            $this->languageDir = $lang_dir;
        }
    }

    /**
     * Eine Templatedatei öffnen.
     *
     * @access    public
     * @param     string $fileName Dateiname des Templates.
     * @uses      $templateName
     * @uses      $templateFile
     * @uses      $templateDir
     * @uses      parseFunctions()
     * @return    boolean
     */
    public function load($fileName)
    {
        $this->templateName = $fileName;
        $this->templateFile = $this->templateDir . $fileName;

        if (!empty($this->templateFile))
        {
            if (file_exists($this->templateFile))
            {
                $this->template = file_get_contents($this->templateFile);
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

        // Funktionen parsen
        $this->parseFunctions();
    }

    /**
     * Einen Standard-Platzhalter ersetzen.
     */
    public function assign($replace, $replacement)
    {
    }

    /**
     * Includes parsen und Kommentare aus dem Template entfernen.
     */
    private function parseFunctions()
    {
    }

    /**
     * Das "fertige Template" ausgeben.
     *
     * @access    public
     * @uses      $template
     */
    public function display()
    {
        echo $this->template;
    }
}
