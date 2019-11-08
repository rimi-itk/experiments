<?php
declare(strict_types=1);

class Hashtags {
    static public function wrapTags(string $input) {
        $text = trim($input);
        // Collects trailing tags one by one.
        $trailingTags = [];
        $pattern = '/\s*#(?<tag>[^\s#]+)$/u';
        while (preg_match($pattern, $text, $matches)) {
            // We're getting tags in reverse order.
            array_unshift($trailingTags, $matches['tag']);
            $text = preg_replace($pattern, '', $text);
        }
        // Wrap inline tags.
        $pattern = '/(#(?<tag>[^\s#]+))/';
        $text = '<div class="text">'.preg_replace($pattern, '<span class="tag">\1</span>', $text).'</div>';
        // Append tags.
        $text .= PHP_EOL.'<div class="tags">'.implode(' ', array_map(function ($tag) {
            return '<span class="tag">#'.$tag.'</span>';
        }, $trailingTags)).'</div>';

        return $text;
    }
}
