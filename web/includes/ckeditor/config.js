/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	
	config.toolbarCanCollapse = true;
	config.width = '100%';
	
	config.toolbar = [
		{ name: 'format', items: [ 'Format' ] },
		{ name: 'presentation', groups: [ 'presentation', 'word' ], items: [ 'Source'] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic'] },
		{ name: 'paragraph', groups: [ 'list', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'Justify', 'JustifyBlock' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Blockquote' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'image', items: [ 'Image','html5video' ] },
		{ name: 'html5video', items: [ 'Html5video' ] }
	];
	config.allowedContent = true;
	
	config.extraPlugins = 'html5video,widget,widgetselection,clipboard,lineutils,uploadwidget,filetools,notification,notificationaggregator,uploadwidget';
	//config.extraPlugins = 'fakeobjects,dialogui,video,dialog';
	
	// config.toolbar = [
	// 	{ name: 'presentation', groups: [ 'presentation', 'word' ], items: [ 'Source', '-', 'Copy', 'Paste', 'PasteText', 'PasteFromWord' ] },
	// 	{ name: 'image', items: [ 'Image' ] },
	// 	{ name: 'format', items: [ 'Format' ] },
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Blockquote' ] },
	// 	{ name: 'paragraph', groups: [ 'list', 'indent', 'align' ], items: [ 'NumberedList', 'BulletedList',  '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'Justify', 'JustifyBlock' ] },
	// 	{ name: 'links', items: [ 'Link', 'Unlink' ] },
	// 	{ name: 'others', items: [ 'Maximize' ] }
	// ];
};
