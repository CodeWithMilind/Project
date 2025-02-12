// to delete product 

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete-product").forEach(button => {
        button.addEventListener("click", function() {
            const productId = this.getAttribute("data-id");
            // alert(productId)
            if (confirm("Are you sure you want to delete this product?")) {
                fetch("../Backend/delete.php", { // Corrected path
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "product_id=" + encodeURIComponent(productId)
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            alert("Product deleted successfully!");
                            location.reload();
                        } else {
                            alert("Error deleting product: " + data);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        });
    });
});