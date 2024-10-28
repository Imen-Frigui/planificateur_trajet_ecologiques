// resources/js/deleteTransport.js

function deletePublicTransport(id) {
    if (!confirm("Are you sure you want to delete this transport?")) return;

    // Construct the delete URL dynamically based on the passed id
    const deleteUrl = `/public-transport/${id}`;

    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Failed to delete public transport");
        }
        return response.json();
    })
    .then(data => {
        console.log("Deletion successful:", data);
        alert("Public transport deleted successfully.");

        // Remove the deleted transport entry from the UI if desired
        document.getElementById(`transport-${id}`).remove();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Failed to delete public transport.");
    });
}
