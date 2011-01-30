<?php
/**
 * Purpose: Generates the HTML and CSS for the site.
 **/

class PageGenerator {
    protected $db;
    
    function __construct() {
        $this->db = new PageGeneratorDB();
    }
    
    // Outputs standard pages
    function generate_html($page) {
        // Calls database and store result in arrays
        $template = $this->db->fetch_loaded("templates");
        $article = $this->db->fetch_article("articles", $page);
        
        return (!empty($template)) ? $this->parse($template, $article) : "";
    }
    
    // Outputs the CSS for the stylesheet
    function generate_css() {
        $stylesheet = $this->db->fetch_loaded("stylesheets");
        
        return (!empty($stylesheet)) ? $stylesheet["content"] : "";
    }
    
    // Replace tags with actual content
    function parse($template, $article) {
        $html = $template["content"];
	$alias = (!empty($article)) ? $article["alias"] : "";
        $title = (!empty($article)) ? $article["title"] : "";
        $content = (!empty($article)) ? $article["content"] : "";
        
	$html = str_replace("{alias}", $alias, $html);
        $html = str_replace("{title}", $title, $html);
        $html = str_replace("{content}", $content, $html);
        
        return $html;
    }
}