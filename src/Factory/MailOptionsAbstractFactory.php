<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-mail
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
 */

namespace DotKernel\DotMail\Factory;

use DotKernel\DotMail\Options\MailOptions;
use Interop\Container\ContainerInterface;
use Zend\Stdlib\ArrayUtils;

/**
 * Class MailOptionsAbstractFactory
 * @package DotKernel\DotMail\Factory
 */
class MailOptionsAbstractFactory extends AbstractMailFactory
{
    const SPECIFIC_PART = 'mail-options';

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $specificServiceName = explode('.', $requestedName)[2];

        $config = $this->getConfig($container);
        $specificConfig = $config[$specificServiceName];
        if(!is_array($specificConfig)) {
            $specificConfig = [];
        }

        /**
         * Merge any extended mail service config into this one
         */
        do {
            $extendsConfigKey = isset($specificConfig['extends']) && is_string($specificConfig['extends'])
                ? trim($specificConfig['extends'])
                : null;

            unset($specificConfig['extends']);

            if(!is_null($extendsConfigKey)
                && array_key_exists($extendsConfigKey, $config)
                && is_array($config[$extendsConfigKey])
            ) {
                $specificConfig = ArrayUtils::merge($config[$extendsConfigKey], $specificConfig);
            }

        } while($extendsConfigKey != null);

        return new MailOptions($specificConfig);
    }
}