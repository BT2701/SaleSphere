<?php
if (isset($_POST['action'])) {
    //Nhớ cập nhật lại maNV
    // $maNV= $_SESSION['userid'];
    $maNV = 1;
    $action = $_POST['action'];
    switch ($action) {
        case 'checkAll':
            if (isset($_POST['checkAll']) && $_POST['checkAll'] == 'true') {

                $invoiceManagementController = new InvoiceManagementController();
                $result = $invoiceManagementController->checkAll();
                echo json_encode($result);
            } else {
                // Trường hợp không có dữ liệu được gửi từ client
                echo "Không có dữ liệu được gửi.";
            }
            break;
        case 'checkPeriod':
            if (isset($_POST['checkPeriod']) && $_POST['checkPeriod'] == 'true') {
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];
                $invoiceManagementController = new InvoiceManagementController();
                $result = $invoiceManagementController->checkPeriod($startDate, $endDate);
                echo json_encode($result);
            } else {
                // Trường hợp không có dữ liệu được gửi từ client
                echo "Không có dữ liệu được gửi.";
            }
            break;
        case 'cancelOrder':
            if (isset($_POST['cancelOrder']) && $_POST['cancelOrder'] == 'true') {
                $invoiceId = $_POST['invoiceId'];
                $invoiceManagementController = new InvoiceManagementController();
                $result = $invoiceManagementController->cancelOrder($invoiceId);
                echo json_encode($result);
            } else {
                // Trường hợp không có dữ liệu được gửi từ client
                echo "Không có dữ liệu được gửi.";
            }
            break;

        case 'confirmOrder':
            if (isset($_POST['confirmOrder']) && $_POST['confirmOrder'] == 'true') {
                $invoiceId = $_POST['invoiceId'];
                $invoiceManagementController = new InvoiceManagementController();
                $result = $invoiceManagementController->confirmOrder($invoiceId);
                if ($result == true) {
                    echo json_encode($maNV);
                }

            } else {
                // Trường hợp không có dữ liệu được gửi từ client
                echo "Không có dữ liệu được gửi.";
            }
            break;

        case 'getInvoiceDetails':
            if (isset($_POST['invoiceId'])) {
                $invoiceId = $_POST['invoiceId'];
                $invoiceManagementController = new InvoiceManagementController();
                $result = $invoiceManagementController->getInvoiceDetails($invoiceId);
                echo json_encode($result);
            } else {
                // Trường hợp không có dữ liệu được gửi từ client
                echo "Không có dữ liệu được gửi.";
            }
            break;
    }

}

class InvoiceManagementController
{
    public function getInstance()
    {
        require_once 'G:\XAMPP\htdocs\web2\MODEL\InvoiceManagementModel.php';
    }
    public function checkAll()
    {
        $this->getInstance();
        $invoiceManagementModel = new InvoiceManagementModel();
        return $invoiceManagementModel->checkAll();
    }

    public function checkPeriod($startDate, $endDate)
    {
        $this->getInstance();
        $invoiceManagementModel = new InvoiceManagementModel();
        return $invoiceManagementModel->checkPeriod($startDate, $endDate);
    }

    public function cancelOrder($invoiceId)
    {
        $this->getInstance();
        $invoiceManagementModel = new InvoiceManagementModel();
        return $invoiceManagementModel->cancelOrder($invoiceId);
    }

    public function confirmOrder($invoiceId)
    {
        $this->getInstance();
        $invoiceManagementModel = new InvoiceManagementModel();
        return $invoiceManagementModel->confirmOrder($invoiceId);
    }

    public function getInvoiceDetails($invoiceId)
    {
        $this->getInstance();
        $invoiceManagementModel = new InvoiceManagementModel();
        return $invoiceManagementModel->getInvoiceDetails($invoiceId);
    }
}


?>