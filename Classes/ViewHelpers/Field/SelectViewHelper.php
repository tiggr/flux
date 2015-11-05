<?php
namespace FluidTYPO3\Flux\ViewHelpers\Field;

/*
 * This file is part of the FluidTYPO3/Flux project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Flux\Form\Field\Select;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * Select-type FlexForm field ViewHelper
 *
 * ### Choosing one of two items
 *
 * Items are given in CSV mode:
 *
 *     <flux:field.select name="settings.position" items="left,right" default="left"/>
 *
 * ### Items with labels
 *
 * If you want to display labels that are different than the values itself,
 * use an object in `items`:
 *
 *      <flux:field.select name="settings.position"
 *                         items="{
 *                                0:{0:'On the left side',1:'left'},
 *                                1:{0:'On the right side',1:'right'}
 *                                }"
 *                        />
 *
 * You can translate those labels by putting a LLL reference in the first property:
 *
 *     LLL:EXT:extname/Resources/Private/Language/locallang.xlf:flux.example.fields.items.foo'
 */
class SelectViewHelper extends AbstractMultiValueFieldViewHelper {

	/**
	 * Initialize
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('items', 'mixed', 'Items for the selector; array / CSV / Traversable / Query supported', TRUE);
		$this->registerArgument('emptyOption', 'mixed', 'If not-FALSE, adds one empty option/value pair to the generated selector box and tries to use this property\'s value (cast to string) as label.', FALSE, FALSE);
	}

	/**
	 * @param RenderingContextInterface $renderingContext
	 * @param array $arguments
	 * @return Select
	 */
	public static function getComponent(RenderingContextInterface $renderingContext, array $arguments) {
		/** @var Select $component */
		$component = static::getPreparedComponent('Select', $renderingContext, $arguments);
		$component->setItems($arguments['items']);
		$component->setEmptyOption($arguments['emptyOption']);
		return $component;
	}

}
