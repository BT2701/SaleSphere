function loadChiTietNhapHang(id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/web2/ROUTES/ChiTietSanPhamRoutes.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataResponse = JSON.parse(this.responseText);
      let html = ``;
      dataResponse.forEach((chiTietPhieuNhap) => {
        html += `<tr>
                                 <td>
                                     <img style="width:50px;height:50px;" src="${chiTietPhieuNhap["src"]}" id="product-image" alt="">
                                     </td>
                                     <td>
                                    ${chiTietPhieuNhap["tenSanPham"]}
                                     </td>
                                     <td>
                                        ${chiTietPhieuNhap["soLuong"]}
                                     </td>
                                 </tr>`;
      });
      //   alert(html);
      document.getElementById("containdetailphieunhap").innerHTML = html;
      $("#detail-modal").modal("show");
    }
  };
  xhr.send(`action=XemChiTietPhieuNhap&idPhieuNhap=${id}`);
}
