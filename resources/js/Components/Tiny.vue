<template>
  <editor
    api-key="ljfuynz3a61fqanmksvqwvil07uc83jbc1ntm6pk31w1n78g"
    :initial-value="content"
    :init="{
      height: 500,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    }"
  />
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

export default {
  name: 'app',
  props: {
    content: String
  },
  components: {
    'editor': Editor
  }
}
</script>
