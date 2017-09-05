<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;

/**
 * Provides the tag for videos. Only a few video services are supported.
 */
class VideoFilter extends AbstractFilter {

    /**
     * Regex pattern.
     */
    const VIDEO_PATTERN = '/^[-_a-z0-9]+$/is';
    const SIZE_PATTERN = '/^(?:small|medium|large)$/i';

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'video' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'default' => self::ALPHA,
                'size' => self::SIZE_PATTERN
            )
        ),
        'youtube' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'vimeo' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'veoh' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'vevo' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                //'size' => self::SIZE_PATTERN Vevo has no sizes
            )
        ),
        'liveleak' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'dailymotion' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'myspace' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'collegehumor' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'funnyordie' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
        'wegame' => array(
            'template' => 'video',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_NONE,
            'contentPattern' => self::VIDEO_PATTERN,
            'attributes' => array(
                'size' => self::SIZE_PATTERN
            )
        ),
    );

    /**
     * Video formats.
     *
     * @type array
     */
    protected $_formats = array(
        'youtube' => array(
            'small' => array(560, 315),
            'medium' => array(640, 360),
            'large' => array(853, 480),
            'player' => 'iframe',
            'path' => '//youtube.com/embed/{id}'
        ),
        'vimeo' => array(
            'small' => array(400, 225),
            'medium' => array(550, 309),
            'large' => array(700, 394),
            'player' => 'iframe',
            'path' => '//player.vimeo.com/video/{id}'
        ),
        'vevo' => array(
            'small' => array(400, 225),
            'medium' => array(575, 324),
            'large' => array(955, 538),
            'player' => 'embed',
            'path' => '//videoplayer.vevo.com/embed/Embedded?videoId={id}&playlist=false&autoplay=0&playerId=62FF0A5C-0D9E-4AC1-AF04-1D9E97EE3961&playerType=embedded'
        ),
        'veoh' => array(
            'small' => array(410, 341),
            'medium' => array(610, 507),
            'large' => array(810, 674),
            'player' => 'embed',
            'path' => '//veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1390&permalinkId={id}&player=videodetailsembedded&videoAutoPlay=0&id=anonymous'
        ),
        'liveleak' => array(
            'small' => array(560, 315),
            'medium' => array(640, 360),
            'large' => array(853, 480),
            'player' => 'iframe',
            'path' => '//liveleak.com/e/{id}'
        ),
        'dailymotion' => array(
            'small' => array(320, 180),
            'medium' => array(480, 270),
            'large' => array(560, 315),
            'player' => 'iframe',
            'path' => '//dailymotion.com/embed/video/{id}'
        ),
        'myspace' => array(
            'small' => array(325, 260),
            'medium' => array(425, 340),
            'large' => array(525, 420),
            'player' => 'embed',
            'path' => '//mediaservices.myspace.com/services/media/embed.aspx/m={id},t=1,mt=video'
        ),
        'collegehumor' => array(
            'small' => array(300, 169),
            'medium' => array(450, 254),
            'large' => array(600, 338),
            'player' => 'iframe',
            'path' => '//collegehumor.com/e/{id}'
        ),
        'funnyordie' => array(
            'small' => array(512, 328),
            'medium' => array(640, 400),
            'large' => array(960, 580),
            'player' => 'iframe',
            'path' => '//funnyordie.com/embed/{id}'
        ),
        'wegame' => array(
            'small' => array(325, 223),
            'medium' => array(480, 330),
            'large' => array(640, 440),
            'player' => 'embed',
            'path' => '//wegame.com/static/flash/player.swf?xmlrequest=http://www.wegame.com/player/video/{id}&embedPlayer=true'
        ),
    );

    /**
     * Custom build the HTML for videos.
     *
     * @param array $tag
     * @param string $content
     * @return string
     */
    public function parse(array $tag, $content) {
        $provider = isset($tag['attributes']['default']) ? $tag['attributes']['default'] : $tag['tag'];
        $size = mb_strtolower(isset($tag['attributes']['size']) ? $tag['attributes']['size'] : 'medium');

        if (empty($this->_formats[$provider])) {
            return sprintf('(Invalid %s video code)', $provider);
        }

        $video = $this->_formats[$provider];
        $size = isset($video[$size]) ? $video[$size] : $video['medium'];

        $tag['attributes']['width'] = $size[0];
        $tag['attributes']['height'] = $size[1];
        $tag['attributes']['player'] = $video['player'];
        $tag['attributes']['url'] = str_replace(array('{id}', '{width}', '{height}'), array($content, $size[0], $size[1]), $video['path']);

        return parent::parse($tag, $content);
    }

}