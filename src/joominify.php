<?php
/**
 *
 * @package plg_joominify
 * @copyright Copyright (C)2013 BlazeWorx. All rights reserved.
 * @license GNU/GPL v2.0, see LICENSE.php
 * @author BlazeWorx (www.blazeworx.com/joominify).
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemJoominify extends JPlugin
{

    public function onAfterRender()
    {

        $app = JFactory::getApplication();
        if ($app->isAdmin()) {
            return;
        }

        $buffer = JResponse::getBody();

        $search = array(
            '/\>[^\S ]+/s', // Remove whitespaces after tags, except space
            '/[^\S ]+\</s', // Remove whitespaces before tags, except space
            '/(\s)+/s' // Shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1'
        );

        $buffer = preg_replace($search, $replace, $buffer);

        JResponse::setBody($buffer);

        return true;
    }

}