<?php declare(strict_types=1);
/*
 *   Copyright 2022 Bastian Schwarz <bastian@codename-php.de>.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */

namespace de\codenamephp\deployer\base\hostCheck;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iCurrentHost;
use de\codenamephp\deployer\base\iConfigurationKeys;
use de\codenamephp\deployer\base\UnsafeOperationException;

/**
 * Just checks the current host alias against the given production alias (defaults to "production") and throws an exception if they match.
 */
final class DoNotRunOnProduction implements iHostCheck {

  public function __construct(public string $productionAlias = iConfigurationKeys::PRODUCTION, public iCurrentHost $deployerFunctions = new All()) {}

  public function check() : void {
    if($this->deployerFunctions->currentHost()->getAlias() === $this->productionAlias) throw new UnsafeOperationException('Current host alias is the same as production alias.');
  }
}