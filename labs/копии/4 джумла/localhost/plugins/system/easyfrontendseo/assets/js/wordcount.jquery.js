/**
 * @Copyright
 * @package     EFSEO - Easy Frontend SEO for Joomal! 3.x
 * @author      Viktor Vogel <admin@kubik-rubik.de>
 * @version     3.4.1 - 2019-06-29
 * @link        https://kubik-rubik.de/efseo-easy-frontend-seo
 *
 * @license     GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
var WordCount = function(target, options) {

    var configuration = {
        inputName: null,
        charText: 'characters',
        wordText: 'words'
    };

    var root = this;

    this.construct = function(target, options) {
        this.configuration = jQuery.extend(configuration, options);
        this.target = jQuery('#' + target);

        if(this.configuration.inputName)
        {
            var input = jQuery('#' + this.configuration.inputName);
            input.on('click keyup', function() {
                root.getCount(input.val());
            });
        }
    };

    this.getCount = function(text) {
        var maxLength = parseInt(jQuery('#' + this.configuration.inputName).attr('maxlength'));
        var numChars = text.length;
        var numWords = (numChars !== 0) ? text.clean().split(' ').length : 0;
        var insertText = numWords + ' ' + this.configuration.wordText + ', ' + (maxLength - numChars) + ' ' + this.configuration.charText;

        if(insertText)
        {
            this.target.text(insertText);
        }
    };

    this.construct(target, options);
};