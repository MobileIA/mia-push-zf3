<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace MIAPush;

return array(
    'service_manager' => [
        'factories' => [
            MobileiaPush::class => Factory\ServiceFactory::class
        ],
    ],
);
