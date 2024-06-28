$(document).ready(function() {
    // Function to fetch leads based on company ID
    function fetchLeadsByCompany(companyId) {
        $.ajax({
            url: '/leadsbycompanyid',
            method: 'GET',
            data: {
                company_id: companyId
            },
            success: function(response) {
                // Clear existing table rows
                $('#example1 tbody').empty();
                
                if (response.length === 0) {
                    $('#example1 tbody').append('<tr><td colspan="6">No leads found for this company.</td></tr>');
                } else {
                    // Populate table with fetched leads
                    $.each(response, function(index, lead) {
                        var row = $('<tr>').appendTo('#example1 tbody');
                      

                        $('<td>').text(lead.company.company_name).css({
                            'background-color': 'blue',
                            'color': 'white',
                            'font-weight': 'bold'
                        }).appendTo(row);
                                              
                        $('<td>').text(lead.vendor.technology_id).appendTo(row);
                        $('<td>').text(lead.vendor.name).appendTo(row);
                        $('<td>').text(lead.interviewer.firstname + ' ' + lead.interviewer.lastname).appendTo(row);
                        $('<td>').text(lead.created_user.firstname).appendTo(row);
                        // Add action column with buttons or links for actions like view, edit, delete
                        // var actionCell = $('<td>').appendTo(row);
                        // Add action buttons or links here
                        
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error(xhr.responseText);
            }
        });
    }

    // Example: Fetch leads when a company is selected
    $('#company_select').change(function() {
        var companyId = $(this).val();
        if (companyId) {
            fetchLeadsByCompany(companyId);
        }
    });
});

// candidate listing checkbox js

