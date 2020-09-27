<?php
/**
 * Creole Plugin, linebreak component: Inserts a line break
 * based on Linebreak Plugin http://wiki.splitbrain.org/plugin:linebreak
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Christopher Smith <chris@jalakai.co.uk>
 * @author     Esther Brunner <wikidesign@gmail.com>
 */

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_creole_linebreak extends DokuWiki_Syntax_Plugin {

    function getType() { return 'substition'; }
    function getSort() { return 100; }

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern(
                '(?<!^|\n)\n(?!\n|>)',
                $mode,
                'plugin_creole_linebreak'
                ); 
    }

    function handle($match, $state, $pos, Doku_Handler $handler) { 

        if ($match == "\n") return true;
        return false;
    }

    function render($mode, Doku_Renderer $renderer, $data) {
        if($mode == 'xhtml') {
            if ($data) {
                if ( $this->getConf('linebreak') == 'Linebreak' ) {
                    $renderer->doc .= "<br />";
                } else {
                    $renderer->doc .= " ";
                }
            }
            return true;
        }
        return false;
    }
}
// vim:ts=4:sw=4:et:enc=utf-8:
