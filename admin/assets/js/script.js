function openModal() {
    document.getElementById('editModal').style.display = "block";
  }
  
  function closeModal() {
    document.getElementById('editModal').style.display = "none";
  }
  
  // Close the modal when clicking outside of it
  window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
      document.getElementById('editModal').style.display = "none";
    }
  }
  function confirmDelete() {
    if (confirm("Are you sure you want to delete this item?")) {
      
      alert("Item deleted successfully."); 
    } else {
      alert("Delete operation canceled.");
    }
  }