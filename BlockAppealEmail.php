<?php
class BlockAppealEmail {
	public static function onParserFirstCallInit(Parser $parser) : void {
		$parser->setHook('blockappealemail', [self::class, 'onBlockAppealEmail']);
	}
	
	public static function onBlockAppealEmail(?string $body, array $args, Parser $parser, PPFrame $frame) : string {
		global $wgBlockAppealEmail;
		
		//disable caching so that the block information is truly up to date
		$parser->getOutput()->updateCacheExpiry(0);
		
		if ($parser->getUserIdentity()->getBlock()) {
			return $wgBlockAppealEmail;
		} else {
			return empty($body) ? '' : $parser->recursiveTagParse($body);
		}
	}
}
