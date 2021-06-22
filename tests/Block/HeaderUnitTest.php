<?php
namespace Slack\Tests\Block;

use Maknz\Slack\Block\Header;
use Maknz\Slack\BlockElement\Text;
use Slack\Tests\TestCase;

class HeaderUnitTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public function testHeaderFromArray()
    {
        $text = new Text([
            'type' => Text::TYPE_PLAIN,
            'text' => 'Text',
        ]);

        $s = new Header([
            'text' => $text,
        ]);

        $this->assertEquals($text, $s->getText());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public function testHeaderFromArrayWithTextArray()
    {
        $s = new Header([
            'text' => [
                'type' => Text::TYPE_MARKDOWN,
                'text' => 'Text',
            ],
        ]);

        $this->assertInstanceOf(Text::class, $s->getText());

        $this->assertEquals(Text::TYPE_MARKDOWN, $s->getText()->getType());

        $this->assertEquals('Text', $s->getText()->getText());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public function testHeaderToArray()
    {
        $in = [
            'text' => [
                'type' => Text::TYPE_MARKDOWN,
                'text' => 'Text',
            ],
            'block_id' => 'test_block',
        ];

        $out = [
            'type' => 'header',
            'text' => [
                'type'     => Text::TYPE_MARKDOWN,
                'text'     => 'Text',
                'verbatim' => false,
            ],
            'block_id' => 'test_block',
        ];

        $s = new Header($in);

        $this->assertEquals($out, $s->toArray());
    }
}
