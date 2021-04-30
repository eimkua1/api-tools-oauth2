<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-oauth2 for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ApiTools\OAuth2\Controller\TestAsset;

use Laminas\ApiTools\ApiProblem\Exception\ProblemExceptionInterface;
use RuntimeException;
use Traversable;

class CustomProblemDetailsException extends RuntimeException implements ProblemExceptionInterface
{
    /** @var string */
    public $type;

    /** @var string */
    public $title;

    /** @var null|array|Traversable */
    public $details;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array|Traversable|null
     */
    public function getAdditionalDetails()
    {
        return $this->details;
    }
}
