<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$title = "Home - Cafe Lupe";
$content = <<<CONTENT
<div style="margin-top:5rem">
    <h1>Hello! We have received your request booking request for</h1>
    <h3>
        Please see the details of your booking below:
    </h3> 
    <div>
        <div>
            Bed Type
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
        <div>
            Room Number
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
        <div>
            Start Date
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
        <div>
            End Date
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
        <div>
            Total
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
        <div>
            Remarks
            <ul>
                <li>
                    Bed Type #1
                </li>
            </ul>
        </div>
    </div>
    <table>
        <thead>
            <th>
                Bed Type
            </th>
            <th>
                Room Number
            </th>
            <th>
                Start Date
            </th>
            <th>
                End Date
            </th>
            <th>
                Total
            </th>
            <th>
                Remarks
            </th>
        </thead>
    </table>

    <table>
        <tbody>
            <tr>
                <td>
                    Bed Type
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
            <tr>
                <td>
                    Room Number
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
            <tr>
                <td>
                    Start Date
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
            <tr>
                <td>
                    End Date
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
            <tr>
                <td>
                    Total
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
            <tr>
                <td>
                    Remarks
                </td>
                <td>
                    Bed Type #1
                </td>
            </tr>
        </tbody>
    </table>
</div>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>