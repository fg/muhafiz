<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS-IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


/**
 * Check syntax errors on php file
 */
class Runners_Php_Php extends Runners_Abstract
{
    function apply(array $files)
    {
        foreach ($files as $file) {
            //force php to display_errors and run php linter, also redirect stderr to stdout
            $out = Utils_System::runCommand("php -l ${file} -d display_errors=1 2>&1");

            if ($out['exitCode'] != 0) {
                throw new Exceptions_RuleFailed("PHP Lint: " . $out['output'][0]);
            }
        }
    }
}
