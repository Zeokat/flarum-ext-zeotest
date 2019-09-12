<?php
/*
 * This file is part of Flarum.
 *
 * The creator of this file is Zeokat
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
use Flarum\Extend;
use Flarum\Frontend\Document;

return [
  (new Extend\Frontend('forum'))
    ->content(function (Document $document) {
      $ads_script = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
      $ads_script .= '<script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-1224297555351654",enable_page_level_ads: true});</script>';
      $document->head[] = $ads_script;
      })
];
