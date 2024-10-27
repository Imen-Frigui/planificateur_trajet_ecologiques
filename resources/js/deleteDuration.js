// resources/js/deleteDuration.js

function deleteDuration(id) {
    if (!confirm("Are you sure you want to delete this Duration?")) return;

    // Construct the delete URL dynamically based on the passed id
    const deleteUrl = `/duration/${id}`;

    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Failed to delete  duration");
        }
        return response.json();
    })
    .then(data => {
        console.log("Deletion successful:", data);
        alert("duration deleted successfully.");

        // Remove the deleted transport entry from the UI if desired
        document.getElementById(`duration-${id}`).remove();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Failed to delete duration.");
    });
}
