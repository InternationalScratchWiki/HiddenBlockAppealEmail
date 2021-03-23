<?php
class BlockAppealEmail {
	public static function onParserFirstCallInit(Parser $parser) : void {
		$parser->setHook('blockappealemail', [self::class, 'onBlockAppealEmail']);
	}
	
	public static function onBlockAppealEmail(?string $body, array $args, Parser $parser, PPFrame $frame) : string {
		global $wgBlockAppealEmail;
		
		if ($parser->getUser()->isBlocked()) {
			return $wgBlockAppealEmail;
		} else {
			return $body || '';
		}
	}
}