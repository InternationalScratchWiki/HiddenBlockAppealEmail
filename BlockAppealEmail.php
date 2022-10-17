<?php

use MediaWiki\Hook\ParserFirstCallInitHook;

class BlockAppealEmail implements ParserFirstCallInitHook {
	public function onParserFirstCallInit($parser) {
		$parser->setHook('blockappealemail', [self::class, 'onBlockAppealEmail']);
	}

	public static function onBlockAppealEmail(?string $body, array $args, Parser $parser, PPFrame $frame): string {
		global $wgBlockAppealEmail;

		//disable caching so that the block information is truly up to date
		$parser->getOutput()->updateCacheExpiry(0);

		if ($parser->getUser()->getBlock()) {
			return $wgBlockAppealEmail;
		} else {
			return $body === null ? '' : $parser->recursiveTagParse($body);
		}
	}
}
