/*Start Search*/
function filterTable(event) {
    event.preventDefault();

    const searchText = document.querySelector('#search').value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach((row) => {
        const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const author = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const summary = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (title.includes(searchText) || author.includes(searchText) || summary.includes(searchText)) {
        row.classList.remove('hidden');
        } else {
        row.classList.add('hidden');
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('#search-form');
    form.addEventListener('submit', filterTable);

    const clearSearchBtn = document.getElementById("clear-search-btn");
    clearSearchBtn.addEventListener("click", clearSearch);

    function clearSearch() {
    const searchInput = document.getElementById("search");
        searchInput.value = "";
    }
});

/*Start Modal*/
const bookTitles = document.querySelectorAll('tbody tr td:nth-child(2)');
const bookImages = document.querySelectorAll('tbody tr td:nth-child(1) img');

const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalAuthor = document.getElementById('modal-author');
const modalSummary = document.getElementById('modal-summary');
const closeBtn = document.querySelector('.close');

function showModal(title, author, summary, imageSrc) {
  modalTitle.textContent = title;
  modalAuthor.textContent = author;
  modalSummary.textContent = summary;
  modal.style.display = 'block';
}

bookTitles.forEach((title, index) => {
  title.addEventListener('click', () => {
    const author = title.parentNode.querySelector('td:nth-child(3)').textContent;
    const summary = title.parentNode.querySelector('td:nth-child(4)').textContent;
    const imageSrc = bookImages[index].src;
    showModal(title.textContent, author, summary, imageSrc);
  });
});

bookImages.forEach((image, index) => {
  image.addEventListener('click', () => {
    const title = image.parentNode.parentNode.querySelector('td:nth-child(2)');
    const author = image.parentNode.parentNode.querySelector('td:nth-child(3)').textContent;
    const summary = image.parentNode.parentNode.querySelector('td:nth-child(4)').textContent;
    const imageSrc = bookImages[index].src;
    showModal(title.textContent, author, summary, imageSrc);
  });
});

closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
});


/*Start Sort*/
function sortTable(n) {
    let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount;
    dir         = "asc";
    table       = document.getElementById("book-table");
    switching   = true;
    switchcount = 0;

    while (switching) {
      switching = false;
      rows = table.getElementsByTagName("tr");
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("td")[n];
        y = rows[i + 1].getElementsByTagName("td")[n];
        if (dir == "asc") {
          if (n == 4) {
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
              shouldSwitch = true;
              break;
            }
          } else {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
        } else if (dir == "desc") {
          if (n == 4) {
            if (Number(x.innerHTML) < Number(y.innerHTML)) {
              shouldSwitch = true;
              break;
            }
          } else {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }

  
/*clear search*/
