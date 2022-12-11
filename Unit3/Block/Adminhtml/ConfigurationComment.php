<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Block\Adminhtml;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Config\Model\Config\CommentInterface;

/**
 *Class that return dynamic comment for system configuration
 */
class ConfigurationComment extends AbstractBlock implements CommentInterface
{
    /**
     * @param $elementValue
     * @return string
     */
    public function getCommentText($elementValue)
    {
        $comment = "1) If Staging & Development it will show username, first 3 characters of password & mode.<br>
                    2) If Production it will show username & mode.";
        return $comment;
    }
}
