document.addEventListener("DOMContentLoaded", function () {
  const addItemButton = document.getElementById('addItemButton');
  const itemsContainer = document.getElementById('itemDetails'); // The container that holds the rows

  // Add new row on button click
  addItemButton.addEventListener('click', function () {
    const newItemRow = `
            <div class="col-md-4 border p-2">
                <input class="form-control" name="item_description[]" placeholder="Item Description" />
            </div>
            <div class="col-md-2 border p-2">
                <input class="form-control" type="text" name="item_gst[]" placeholder="GST (%)" oninput="calculateNetAmount()">
            </div>
            <div class="col-md-2 border p-2">
                <input class="form-control" type="text" name="item_discount[]" placeholder="Discount (%)" oninput="calculateNetAmount()">
            </div>
            <div class="col-md-2 border p-2">
                <input class="form-control" type="text" name="total_amount[]" placeholder="Total Amount" oninput="calculateNetAmount()">
            </div>
            <div class="col-md-2 border p-2">
                <button type="button" class="btn btn-danger remove-row">Remove</button>
            </div>
            `;
    itemsContainer.insertAdjacentHTML('beforeend', newItemRow);
  });

  // Remove row functionality
  itemsContainer.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-row')) {
      event.target.closest('.row').remove();
      calculateNetAmount(); // Recalculate the total after removing
    }
  });
});

function calculateNetAmount() {
  let totalAmount = 0;
  let totalTax = 0;

  document.querySelectorAll('#itemDetails .row').forEach((row, index) => {
      let price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
      let discountRate = parseFloat(row.querySelector('input[name="discount_rate[]"]').value) || 0;
      let igstRate = parseFloat(row.querySelector('input[name="igst_rate[]"]').value) || 0;

      let discountAmount = (discountRate / 100) * price;
      let amountAfterDiscount = price - discountAmount;

      let taxAmount = (igstRate / 100) * amountAfterDiscount;
      let netAmount = amountAfterDiscount + taxAmount;

      totalAmount += netAmount;
      totalTax += taxAmount;
  });

  // Update the totals in the form
  document.getElementById('totalAmountDisplay').innerText = totalAmount.toFixed(2);
  document.getElementById('taxDisplay').innerText = totalTax.toFixed(2);
  document.getElementById('netAmountDisplay').innerText = totalAmount.toFixed(2);

  document.getElementById('netAmount').value = totalAmount;
  document.getElementById('taxAmount').value = totalTax;
}


// This function will be triggered by item row calculations
function calculateTotalAmount() {
  let oneAmount = parseFloat(document.getElementById("totalInput").value);
  if (isNaN(oneAmount)) {
    oneAmount = 0;
  }
  document.getElementById("totalDisplay").innerText = oneAmount.toFixed(2);
}
