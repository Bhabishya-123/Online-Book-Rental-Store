function getCurrentDate() {
    return new Date().toLocaleDateString('en-US');
  }
  
function calculateReturnDays() {
    var currentDate = getCurrentDate();
    var selectedReturnDate = document.getElementById('returnDate').value;

    var returnDate = new Date(selectedReturnDate);
  
    var timeDifference = returnDate - currentDate;
    var numDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
  
    console.log("Number of days between the two dates: " + numDays);
  }