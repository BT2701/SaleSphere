<?php
     require_once __DIR__.'\..\..\..\MODEL\Database.php';
    $name=$_POST['data'];
    $array = explode(",", $name);
    $key=$array[0];
    $loai=$array[1];
    if($loai=="name"){
        $sql="SELECT users.id,users.email,users.sdt,taikhoan.tenTaiKhoan,taikhoan.matKhau,taikhoan.TinhTrang,quyen.tenQuyen
                FROM users,taikhoan,quyen
                where taikhoan.tenTaiKhoan like '%$key%' AND users.id=taikhoan.id AND taikhoan.maQuyen=quyen.id  ORDER BY users.id ASC";
        $db = new Database();
        $conn = $db->getConnection();
        $query=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($query);
        if($num>0)
        {
            while($row = mysqli_fetch_array($query))
            {

                ?>
                    <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['tenTaiKhoan'] ?></td>
                            <td><?php if($row['email']=='0'||$row['email']=='') {echo "Chưa cập nhật";} else {echo $row['email'];} ?></td>
                            <td><?php if($row['sdt']=='0'||$row['sdt']=='') {echo "Chưa cập nhật";} else {echo $row['sdt'];} ?></td>
                            <td><?php echo $row['matKhau'] ?></td>
                            <td><?php echo $row['tenQuyen'] ?></td>
                            <td><?php if($row['TinhTrang']==1) {echo "Đang hoạt động";} else {echo "Bị khóa";} ?></td>
                            <td ><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=sua&&id=<?php echo $row['id']?>" class="link-dark btn btn-success" style="text-align: center;"><i class="fa-solid fa-pen-to-square fs-5"></i></a></td>
                            <td><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=xoa&&id=<?php echo $row['id']?>" class="link-dark btn btn-danger"><i class="fa-solid fa-trash fs-5"></i></a></td>
                        </tr>  
                <?php
            }
        }
    }  
    else if($loai=="email")
    {
        $sql="SELECT users.id,users.email,users.sdt,taikhoan.tenTaiKhoan,taikhoan.matKhau,taikhoan.TinhTrang,quyen.tenQuyen
        FROM users,taikhoan,quyen
        where users.email like '%$key%' AND users.id=taikhoan.id AND taikhoan.maQuyen=quyen.id  ORDER BY users.id ASC";
        $db = new Database();
        $conn = $db->getConnection();
        $query=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($query);
        if($num>0)
        {
            while($row = mysqli_fetch_array($query))
            {

                ?>
                    <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['tenTaiKhoan'] ?></td>
                            <td><?php if($row['email']=='0'||$row['email']=='') {echo "Chưa cập nhật";} else {echo $row['email'];} ?></td>
                            <td><?php if($row['sdt']=='0'||$row['sdt']=='') {echo "Chưa cập nhật";} else {echo $row['sdt'];} ?></td>
                            <td><?php echo $row['matKhau'] ?></td>
                            <td><?php echo $row['tenQuyen'] ?></td>
                            <td><?php if($row['TinhTrang']==1) {echo "Đang hoạt động";} else {echo "Bị khóa";} ?></td>
                            <td ><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=sua&&id=<?php echo $row['id']?>" class="link-dark btn btn-success" style="text-align: center;"><i class="fa-solid fa-pen-to-square fs-5"></i></a></td>
                            <td><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=xoa&&id=<?php echo $row['id']?>" class="link-dark btn btn-danger"><i class="fa-solid fa-trash fs-5"></i></a></td>
                        </tr>  
                <?php
            }
        }
    }
    elseif($loai=="phone_number")
    {
        $sql="SELECT users.id,users.email,users.sdt,taikhoan.tenTaiKhoan,taikhoan.matKhau,taikhoan.TinhTrang,quyen.tenQuyen
        FROM users,taikhoan,quyen
        where users.sdt like '%$key%' AND users.id=taikhoan.id AND taikhoan.maQuyen=quyen.id  ORDER BY users.id ASC";
        $db = new Database();
        $conn = $db->getConnection();
        $query=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($query);
        if($num>0)
        {
            while($row = mysqli_fetch_array($query))
            {

                ?>
                    <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['tenTaiKhoan'] ?></td>
                            <td><?php if($row['email']=='0'||$row['email']=='') {echo "Chưa cập nhật";} else {echo $row['email'];} ?></td>
                            <td><?php if($row['sdt']=='0'||$row['sdt']=='') {echo "Chưa cập nhật";} else {echo $row['sdt'];} ?></td>
                            <td><?php echo $row['matKhau'] ?></td>
                            <td><?php echo $row['tenQuyen'] ?></td>
                            <td><?php if($row['TinhTrang']==1) {echo "Đang hoạt động";} else {echo "Bị khóa";} ?></td>
                            <td ><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=sua&&id=<?php echo $row['id']?>" class="link-dark btn btn-success" style="text-align: center;"><i class="fa-solid fa-pen-to-square fs-5"></i></a></td>
                            <td><a href="/SaleSphere/VIEWS/admin/admin_home.php?page=quanLyTaiKhoan&&chon=xoa&&id=<?php echo $row['id']?>" class="link-dark btn btn-danger"><i class="fa-solid fa-trash fs-5"></i></a></td>
                        </tr>  
                <?php
            }
        }
    }
?>
    
