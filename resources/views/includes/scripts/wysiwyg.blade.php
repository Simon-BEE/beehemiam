<script>
    const editorButtons = document.querySelectorAll('.editor-button');
    const showViews = document.querySelectorAll('.show-view');

    checkListElements();

    editorButtons.forEach((button) => {
        button.addEventListener('click', function(e) {
            const action = this.getAttribute('data-action');

            switch (action) {
            case 'code':
                execCodeAction(e.currentTarget, e.currentTarget.parentNode.parentNode.parentNode.parentNode);
                break;
            case 'createLink':
                execLinkAction();
                break;
            default:
                execDefaultAction(action);
                break;
            }
        });
    });

    function execDefaultAction(action) {
        document.execCommand(action, false, null);
        checkListElements();
    }

    function execLinkAction() {
        let linkValue = prompt('URL (e.g. https://google.com/)');
        document.execCommand('createLink', false, linkValue);
        document.getSelection().focusNode.parentNode.classList.add("text-green-500", 'hover:underline');
    }

    function execCodeAction(button, editor){
        
        let htmlView = editor.querySelector('.html-view');
        let showView = editor.querySelector('.show-view');
        if (htmlView.classList.contains('hidden')) {
            htmlView.classList.replace('hidden', 'block');
            showView.classList.replace('block', 'hidden');
        } else {
            showView.classList.replace('hidden', 'block');
            htmlView.classList.replace('block', 'hidden');
        }

        button.classList.toggle('bg-gray-200');
    }

    showViews.forEach(showView => showView.addEventListener('keyup', () => {
        pushContentInTextarea(showView);
    }));

    function checkListElements() {
        showViews.forEach(showView => showView.querySelectorAll('ul').forEach(list => {
            if (!list.classList.contains('list-disc')) {
                list.classList.add('p-2', 'bg-gray-100', 'my-2', 'list-disc', 'list-inside', 'dark:bg-gray-900', 'rounded');
            }
        }));
    }

    function pushContentInTextarea(showView) {
        let htmlView = showView.parentNode.querySelector('.html-view');
        htmlView.value = showView.innerHTML;
    }
</script>