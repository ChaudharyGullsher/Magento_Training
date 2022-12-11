<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Helper\Data;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 *ConfigProvider Class for configuration values
 */
class ConfigProvider extends AbstractHelper
{
    /**
     *Config variable for username
     */
    private const USERNAME = 'unit3/general/username';
    /**
     *Config Variable for password
     */
    private const PASSWORD = 'unit3/general/password';
    /**
     *Config Variable for environment
     */
    private const ENVIRONMENT = 'unit3/general/environment';

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getConfigValue(self::USERNAME);
    }

    /**
     * @param $config_path
     * @return mixed
     */
    public function getConfigValue($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getConfigValue(self::PASSWORD);
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->getConfigValue(self::ENVIRONMENT);
    }
}
