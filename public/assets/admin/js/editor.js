$(document).ready(function () {
  initEditor();
});

if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
  CKEDITOR.tools.enableHtml5Elements( document );

CKEDITOR.config.toolbar = [
  {
    name: 'basicstyles',
    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
  },
  {
    name: 'paragraph',
    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
  },
  {
    name: 'links',
    items: ['Link', 'Unlink']
  },
  {
    name: 'document',
    items: ['Source']
  },
  {
    name: 'insert',
    items: ['Table']
  }
];
CKEDITOR.config.pasteFilter = null;
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

var initEditor = (function() {
  let wysiwygAreaAvailable = isWysiwygAreaAvailable();

  return function() {
    let editorComment = CKEDITOR.document.getById( 'comment' );
    let editorClubComment = CKEDITOR.document.getById( 'club_comment' );
    let editorOffer = CKEDITOR.document.getById( 'offer' );

    if ( wysiwygAreaAvailable ) {
      if (editorComment) {
        CKEDITOR.replace( 'comment' );
      }

      if (editorClubComment) {
        CKEDITOR.replace( 'club_comment' );
      }

      if (editorOffer) {
        CKEDITOR.replace( 'offer' );
      }
    } else {
      if (editorComment) {
        editorComment.setAttribute( 'contenteditable', 'true' );
        CKEDITOR.inline( 'comment' );
      }

      if (editorClubComment) {
        editorClubComment.setAttribute('contenteditable', 'true');
        CKEDITOR.inline('club_comment');
      }

      if (editorOffer) {
        editorOffer.setAttribute('contenteditable', 'true');
        CKEDITOR.inline('offer');
      }
    }
  };

  function isWysiwygAreaAvailable() {
    if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
      return true;
    }

    return !!CKEDITOR.plugins.get( 'wysiwygarea' );
  }
})();
