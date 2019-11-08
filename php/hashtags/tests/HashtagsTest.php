<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class HashtagsTest extends TestCase
{
    /**
     * @dataProvider wraptagsData
     */
    public function testWraptags(string $input, string $expected) {
        $actual = Hashtags::wrapTags($input);

        $this->assertSame($actual, $expected);
    }

    public function wraptagsData() {
        return [
            [
               'Hej #troels 👻Hvad laver du? 🍓#a #b🚴k #c ',
               <<<'EXPECTED'
<div class="text">Hej <span class="tag">#troels</span> 👻Hvad laver du? 🍓</div>
<div class="tags"><span class="tag">#a</span> <span class="tag">#b🚴k</span> <span class="tag">#c</span></div>
EXPECTED
            ],
            [
          'Many #people use way too many #hashtags',
               <<<'EXPECTED'
<div class="text">Many <span class="tag">#people</span> use way too many</div>
<div class="tags"><span class="tag">#hashtags</span></div>
EXPECTED
            ]
        ];
    }
}