// Quill setup
const quill = new Quill('#editor', {
  theme: 'snow'
});

// Sync Quill → hidden input before submit
const form = document.getElementById("postForm");
const contentInput = document.getElementById("content");

form.addEventListener("submit", function () {
  contentInput.value = quill.root.innerHTML;
});