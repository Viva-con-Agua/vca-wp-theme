/* eslint-disable no-undef */
/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerBlockStyle } = wp.blocks;

registerBlockStyle('core/image', {
    name: 'framed-image',
    label: __('Rahmen'),
    isDefault: false,
});
