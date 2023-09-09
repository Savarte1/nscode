<?php

require(dirname(__FILE__).'/vendor/autoload.php');

use dokuwiki\Extension\SyntaxPlugin;
/**
 * DokuWiki Plugin nscode (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author Savonir <artevenia@gmail.com>
 */
class syntax_plugin_nscode extends SyntaxPlugin
{
    /** @inheritDoc */
    public function getType()
    {
        return 'protected';
    }

    /** @inheritDoc */
    public function getPType()
    {
        return 'normal';
    }

    /** @inheritDoc */
    public function getSort()
    {
        return 62;
    }

    /** @inheritDoc */
    public function connectTo($mode)
    {
        $this->Lexer->addEntryPattern('<nscode>', $mode, 'plugin_nscode');
    }

    /** @inheritDoc */
   public function postConnect()
   {
        $this->Lexer->addExitPattern('</nscode>', 'plugin_nscode');
   }

    /** @inheritDoc */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        switch ($state) {
            case DOKU_LEXER_ENTER : return array($state, '');
            case DOKU_LEXER_UNMATCHED :  return array($state, $match);
            case DOKU_LEXER_EXIT :       return array($state, '');
        }

    }

    /** @inheritDoc */
    public function render($mode, Doku_Renderer $renderer, $data)
    {

        if ($mode !== 'xhtml') {
            return false;
        }

        list($state,$match) = $data;
        switch ($state) {
            case DOKU_LEXER_ENTER :
                $renderer->doc .= "<div class='nscode-wiki'>"; 
                break;

            case DOKU_LEXER_UNMATCHED:
                $configurator = new s9e\TextFormatter\Configurator;
                $configurator->rootRules->enableAutoLineBreaks();
                $configurator->BBCodes->addFromRepository('B');
                $configurator->BBCodes->addFromRepository('I');
                $configurator->BBCodes->addFromRepository('U');
                $configurator->BBCodes->addFromRepository('IMG');
                $configurator->BBCodes->addFromRepository('LEFT');
                $configurator->BBCodes->addFromRepository('CENTER');
                $configurator->BBCodes->addFromRepository('RIGHT');
                $configurator->BBCodes->addFromRepository('ALIGN');
                $configurator->BBCodes->addFromRepository('LIST');
                $configurator->BBCodes->addFromRepository('*');
                $configurator->BBCodes->addFromRepository('SIZE');
                $configurator->BBCodes->addFromRepository('FLOAT');
                $configurator->BBCodes->addFromRepository('URL');
                $configurator->BBCodes->addFromRepository('SUP');
                $configurator->BBCodes->addFromRepository('SUB');
                $configurator->BBCodes->addFromRepository('HR');
                $configurator->BBCodes->addCustom(
                    '[nation]{SIMPLETEXT}[/nation]',
                    '<a href="https://www.nationstates.net/nation={SIMPLETEXT}" rel="ugc nofollow">{SIMPLETEXT}</a>'
                );
                $configurator->BBCodes->addCustom(
                    '[region]{SIMPLETEXT}[/region]',
                    '<a href="https://www.nationstates.net/region={SIMPLETEXT}" rel="ugc nofollow">{SIMPLETEXT}</a>'
                );
                $configurator->BBCodes->addCustom(
                    '[box]{TEXT}[/box]',
                    '<div style="border: 1px solid #000; padding: 5px; margin-bottom: 10px;">{TEXT}</div>'
                );
                $bbparser = $configurator->finalize();

                $xml  = $bbparser["parser"]->parse($match);
                $html = $bbparser["renderer"]->render($xml);
                $renderer->doc .= $html; 
                break;
            case DOKU_LEXER_EXIT:     
                $renderer->doc .= "</div>"; 
                break;
        }

        return true;
    }
}
