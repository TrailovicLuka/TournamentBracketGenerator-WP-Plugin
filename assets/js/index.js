import ajaxCall from './modules/ajaxCall.js';
import  loadSettingFields from './modules/settings-page.js';

window.addEventListener('DOMContentLoaded', (event) => {
	
	loadSettingFields();
	ajaxCall();

})
