/* eslint-disable no-undef */
(function () {
  // eslint-disable-next-line no-undef
  tinymce.PluginManager.add('my_mce_button', function (editor, url) {
    editor.addButton('my_mce_button', {
      text: false,
      icon: 'link',
      type: 'button',
      title: '内链文章',
      onclick: function () {
        editor.windowManager.open({
          title: '内链文章',
          width: 320,
          height: 60,
          body: [{
            type: 'listbox',
            name: 'listboxName',
            label: '链接文本',
            values: [
              { text: 'Firefox', value: 'Firefox' },
              { text: 'LibreOffice', value: 'LibreOffice' },
              { text: 'Microsoft Edge', value: 'Microsoft Edge' },
              { text: 'ThinkPad', value: 'ThinkPad' },
              { text: 'vivo', value: 'vivo' },
              { text: 'Windows 7', value: 'Windows 7' },
              { text: 'Windows 10', value: 'Windows 10' },
              { text: '三星', value: '三星' },
              { text: '微软', value: '微软' }
            ]
          }],
          onsubmit: function (e) {
            let url = ''
            if (e.data.listboxName === 'Firefox') {
              url = 'https://getkit.cn/1966.html'
            } else if (e.data.listboxName === 'Windows 7') {
              url = 'https://getkit.cn/510.html'
            } else if (e.data.listboxName === 'Windows 10') {
              url = 'https://getkit.cn/705.html'
            } else if (e.data.listboxName === 'ThinkPad') {
              url = 'https://s.click.taobao.com/t?e=m%3D2%26s%3DS3R8qFYrp2ocQipKwQzePDAVflQIoZepK7Vc7tFgwiFRAdhuF14FMebPJCEYVugB1aH1Hk3GeOhIcDiOr%2FQeM%2FbM7dcbbH9JCuggvxkWmsj%2BnjlhYZk46LWhDZczhR%2FlEfta9pw0SeUhhQs2DjqgEA%3D%3D'
            } else if (e.data.listboxName === 'LibreOffice') {
              url = 'https://getkit.cn/556.html'
            } else if (e.data.listboxName === 'Microsoft Edge') {
              url = 'https://getkit.cn/191.html'
            } else if (e.data.listboxName === '微软') {
              url = 'https://s.click.taobao.com/t?e=m%3D2%26s%3DUxT%2FXcdxTXIcQipKwQzePDAVflQIoZepK7Vc7tFgwiFRAdhuF14FMbVRs1p05GtiRitN3%2FurF3xIcDiOr%2FQeM%2FbM7dcbbH9JCuggvxkWmsj%2BnjlhYZk46AD8AN4Mp7DtqfjhUc8J4BUhhQs2DjqgEA%3D%3D'
            } else if (e.data.listboxName === 'vivo') {
              url = 'https://s.click.taobao.com/t?e=m%3D2%26s%3DIvsksvEUdBgcQipKwQzePDAVflQIoZepK7Vc7tFgwiFRAdhuF14FMfaKARt%2FFyec8sviUM61dt1IcDiOr%2FQeM%2FbM7dcbbH9JCuggvxkWmsj%2BnjlhYZk46NPNnBRLS40Gl43smN4JipbGDmntuH4VtA%3D%3D'
            } else if (e.data.listboxName === '三星') {
              url = 'https://s.click.taobao.com/t?e=m%3D2%26s%3DOcy8VYKF5kUcQipKwQzePDAVflQIoZepK7Vc7tFgwiFRAdhuF14FMZyxzTE4paAo5x%2BIUlGKNpVIcDiOr%2FQeM%2FbM7dcbbH9JCuggvxkWmsj%2BnjlhYZk46OxF50eqLe%2FvJrIseLgZ%2FCjGDmntuH4VtA%3D%3D'
            }

            editor.insertContent('<a href="' + url + '" target="_blank">' + e.data.listboxName + '</a>')
          }
        })
      }
    })
  })
  tinymce.PluginManager.add('table', function (editor, url) {
    // Add a button that opens a window
    editor.addButton('table', {
      text: false,
      icon: 'table',
      title: '插入表格',
      onclick: function () {
        // Open window
        editor.windowManager.open({
          title: '插入表格',
          body: [
            { type: 'textbox', name: 'column', label: '列数' },
            { type: 'textbox', name: 'row', label: '行数' },
            {
              type: 'listbox',
              name: 'style',
              label: '排列',
              values: [
                { text: '边框(推荐)', value: 'bordered' },
                { text: '横向', value: 'horizontal' }
              ]
            },
            {
              type: 'listbox',
              name: 'wrap',
              label: '换行',
              values: [
                { text: '否(推荐)', value: 'nowrap' },
                { text: '是', value: 'wrap' }
              ]
            }
          ],
          onsubmit: function (e) {
            const column = e.data.column
            const row = e.data.row
            const style = ' pure-table-' + e.data.style
            const wrap = ' table-' + e.data.wrap
            if (column >= '1' && row >= '1') {
              let html = '<div class="table-responsive"><table class="pure-table' + style + wrap + '"><tbody>'
              for (let i = 0; i < row; i++) {
                html += '<tr>'
                for (let j = 0; j < row; j++) {
                  html += '<td></td>'
                }
                html += '</tr>'
              }
              html += '</tbody></table></div>'
              // Insert content when the window form is submitted
              editor.insertContent(html)
            }
          }
        })
      }
    })
  })
})()
