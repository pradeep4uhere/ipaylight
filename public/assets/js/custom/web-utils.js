Inputmask({
    "mask" : "9999-9999-9999"
}).mask("#kt_inputmask_2");

/**
 * Functions Used when user select status of the User
 * If Stauts  is In Active, then this function has to be enable
 * List of all other Reason for User Why user has been updated to Inactive.
 */
function getInActiveReason(val){
    if(val=='inactive'){
        $("#in-active-status-list").show();
        $("#in-active-status-list1").show();
    }else{
        $("#in-active-status-list").hide();
        $("#status_reason").val("");
        $("#in-active-status-list1").hide();
    }
}


function getDistributorList(e){
    //alert(e.value)
    if(e.value === 'retailer'){
        $("#dsList").show();
        $("#superdistributor").hide();
    }else if(e.value === 'distributor'){
        $("#dsList").hide();
        $("#superdistributor").show();
    }else{
        $("#dsList").hide();
        $("#superdistributor").hide();
    }

}


function getSuperDistributorList(e){
    if(e === 'yes'){
        $("#sdsList").show();
    }else{
        $("#sdsList").hide();
    }
}


function numberToWords(number) {
    const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    const teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function convertHundred(num) {
        let word = '';
        if (num >= 100) {
            word += ones[Math.floor(num / 100)] + ' hundred ';
            num %= 100;
        }
        if (num >= 20) {
            word += tens[Math.floor(num / 10)] + ' ';
            num %= 10;
        }
        if (num >= 10) {
            word += teens[num - 10] + ' ';
            num = 0;
        }
        if (num > 0) {
            word += ones[num] + ' ';
        }
        return word.trim();
    }

function convertThousand(num) {
        let word = '';
        if (num >= 1000) {
            word += convertHundred(Math.floor(num / 1000)) + ' thousand ';
            num %= 1000;
        }
        word += convertHundred(num);
        return word.trim();
    }

    if (number === 0) {
        return 'zero';
    }
    if (number < 0) {
        return 'minus ' + numberToWords(-number);
    }
    let word = '';
    let postfix = '';
    if (number >= 1000000000000) {
        word += convertThousand(Math.floor(number / 1000000000000)) + ' trillion ';
        number %= 1000000000000;
    }
    if (number >= 1000000000) {
        word += convertThousand(Math.floor(number / 1000000000)) + ' billion ';
        number %= 1000000000;
    }
    if (number >= 1000000) {
        word += convertThousand(Math.floor(number / 1000000)) + ' million ';
        number %= 1000000;
    }
    if (number >= 1000) {
        word += convertThousand(Math.floor(number / 1000)) + ' thousand ';
        number %= 1000;
    }
    word += convertHundred(number);
    return word.trim().replace(/-/g, '').replace(/\s+/g, ' ');
}


$(".routingDiv").on('click', function() {
    var routeUrl = $(this).data('route');
    var title = $(this).data('title');
    $.ajax({
        url: routeUrl,
        type: "GET",
        success: function(response) {
            // Handle the response data and load it into your page
            $("#dashboard_content").html(response);
            $("#PageTitle").html(title);
        },
        error: function(xhr, status, error) {
            // Handle errors if any
            console.error(xhr.responseText);
        }
    });
});


$(".selectBank").on('change',function(){
    var value = $(this).val();
    //alert(value);
    var ifscCode = $(this).find(':selected').data('ifsc-code');
    if(ifscCode!=null){
        $('#ifsc_code').val(ifscCode);
    }
});



$(document).ready(function() {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('.transferNow').on('click',function(){
    var indentifier = $(this).data('indentifier');
    var routeUrl = $(this).data('route-url');
    //alert(indentifier);
    $.ajax({
        url: routeUrl,
        type: "POST",
        data: { indentifier: indentifier },
        success: function(response) {
            // Handle the response data and load it into your page
            $("#model-body-content").html(response);
        },
        error: function(xhr, status, error) {
            // Handle errors if any
            console.error(xhr.responseText);
        }
    });
});

});



$(document).ready(function() {
    $(document).on('click', '.kt_drawer_example_basic_button', function() {
        //alert('dasd');
        var idStr = $(this).attr('id');
        //alert(idStr);
        var urlText = $(this).attr('data-url');
        var enltid = $(this).attr('data-tid');  // It will return me the data
        KTDrawer.createInstances();
        var drawerElement = document.querySelector("#kt_drawer_example_basic");
        var drawer = KTDrawer.getInstance(drawerElement);
        drawer.show();
        // Example usage:
        const apiUrl = urlText;
        // Make a POST request with data
        const requestData = { ltid: enltid };
        makeAjaxRequest(apiUrl, 'POST', requestData)
            .then(responseData => {
                // Handle successful response
                console.log('Response:', responseData);
                $("#kt_drawer_example_basic").html(responseData);
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
            });
     });
});




$(document).ready(function() {
    // Use event delegation
    $('body').on('click', '.dmttransferNow', function() {
        var indentifier = $(this).data('indentifier');
        var servicename = $(this).data('servicename');
        var routeUrl = $(this).data('route-url');
        $.ajax({
            url: routeUrl,
            type: "POST",
            data: { indentifier: indentifier, service: servicename },
            success: function(response) {
                // Handle the response data and load it into your page
                $("#model-body-content").html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        });
    });
});

function makeAjaxRequest(url, method, data) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: method,
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                // Check if response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.indexOf('text/html') !== -1) {
                        return response.text(); // Parse response body as text
                }
                return response.json(); // Parse response body as JSON
            })
            .then(data => {
                // Resolve promise with response data
                resolve(data);
            })
            .catch(error => {
                // Reject promise with error
                reject(error);
            });
        });
}


$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});


$(document).ready(function() {
    $(document).on('submit', '.verifyAccountForm', function(event) {
        $("#errorMsg").hide();
        $("#successMsg").hide();
        event.preventDefault(); // Prevent the default form submission
        var form = $(this);
        var formData = form.serialize(); // Serialize the form data
        $.ajax({
            url: form.attr('action'), // Use the form's action URL
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.status){
                    $("#successMsg").show();
                    $("#successMsg").html(response.message);
                    let identifier = response.identifier;
                    console.log("Identifier: ", identifier);
                    console.log("Form to hide: ", '#verifyForm_'+identifier);
                    console.log("Button to show: ", '#transferNowButton_'+identifier);
                    $('#verifyForm_'+identifier).hide();
                    $('#transferNowButton_'+identifier).show();
                }else{
                    $("#errorMsg").show();
                    $("#errorMsg").html(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle errors if any
                console.error(xhr.responseText);
                alert('Failed to verify account. Please try again.');
            }
        });
    });
});


