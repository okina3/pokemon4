import './bootstrap';

import Alpine from 'alpinejs';

// 依存関係のjQueryをインポート
import jQuery from 'jquery';
// Select2をインポート
import select2 from 'select2'

// '$'をjQueryとして使用する
window.$ = jQuery;
// 'jQuery'をjQueryとして使用する
window.jQuery = jQuery

// Select2が使用するjQueryを指定する
select2($)

window.Alpine = Alpine;

Alpine.start();
