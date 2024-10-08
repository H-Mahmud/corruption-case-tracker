<div class="wrap">
    <h2>Import Cases From CSV</h2>

    <form method="post" id="importData">
        <div class="import-container">
            <table class="form-table">
                <tr>
                    <th><label for="csvFile">Insert A CSV File</label></th>
                    <td>
                        <div>
                            <button class="button" id="insertCsv">Insert CSV</button>
                            <input type="hidden" required name="csv-file" id="csvFile" value="" />
                            <a href="#" class="remove-csv">Remove CSV</a>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="spinner import-spinner"></div>
            <p id="error-message" style="color:red"></p>
            <p id="success-message" style="color: green;"></p>
        </div>
    </form>

</div>
