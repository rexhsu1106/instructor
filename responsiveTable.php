<style type="text/css">
.responsive-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1rem;
}

.responsive-table th,
.responsive-table td {
  padding: 0.75rem;
  text-align: left;
  border: 1px solid #ddd;
}

.responsive-table th {
  background-color: #f8f9fa;
  font-weight: bold;
}

@media screen and (max-width: 768px) {
  .responsive-table {
    border: 0;
  }
  
  .responsive-table thead {
    display: none;
  }
  
  .responsive-table tr {
    margin-bottom: 10px;
    display: block;
    border: 1px solid #ddd;
  }
  
  .responsive-table td {
    display: block;
    text-align: right;
    border-bottom: 1px dotted #ddd;
    border-left: 0;
    border-right: 0;
  }
  
  .responsive-table td:last-child {
    border-bottom: 0;
  }
  
  .responsive-table td:before {
    content: attr(data-label);
    float: left;
    font-weight: bold;
  }
}
</style>

<table class="responsive-table">
  <thead>
    <tr>
      <?php
      $columns = [
        '姓名', '年齡', '職業', '城市', '電話', '郵箱', '學歷', '薪資',
        '部門', '職位', '入職日期', '生日', '性別', '婚姻狀況', '地址',
        '緊急聯繫人', '專業技能', '語言能力', '愛好', '備註'
      ];
      foreach ($columns as $column) {
        echo "<th>{$column}</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $data = [
      ['張三', '28', '工程師', '台北', '0912345678', 'zhang@example.com', '大學', '50000',
       'IT部', '高級工程師', '2020-01-01', '1995-05-15', '男', '未婚', '台北市中山區',
       '李四 (父親)', 'Java, Python', '英語流利', '閱讀, 旅遊', '表現優秀'],
      // 可以添加更多行數據...
    ['李四', '35', '銷售經理', '新北', '0987654321', 'li@example.com', '碩士', '80000',
     '銷售部', '部門經理', '2018-03-15', '1988-09-20', '女', '已婚', '新北市板橋區',
     '王五 (配偶)', '銷售策略, 客戶關係管理', '英語流利, 日語中級', '高爾夫, 烹飪', '業績優秀'],
    ['王五', '42', '財務總監', '台中', '0923456789', 'wang@example.com', '博士', '120000',
     '財務部', '高級主管', '2015-07-01', '1981-12-10', '男', '已婚', '台中市西屯區',
     '趙六 (妻子)', '財務分析, 風險管理', '英語流利, 德語初級', '攝影, 登山', '經驗豐富'],
    ['趙六', '31', '人力資源專員', '高雄', '0934567890', 'zhao@example.com', '大學', '45000',
     '人力資源部', '專員', '2019-09-01', '1992-03-25', '女', '未婚', '高雄市鳳山區',
     '孫七 (母親)', '招聘, 培訓', '英語中級', '瑜伽, 繪畫', '積極主動'],
    ['孫七', '39', '市場營銷經理', '台南', '0945678901', 'sun@example.com', '碩士', '75000',
     '市場部', '部門經理', '2017-05-20', '1984-08-05', '男', '已婚', '台南市東區',
     '周八 (父親)', '市場分析, 品牌管理', '英語流利, 韓語中級', '跑步, 音樂', '創新思維']
    ];

    foreach ($data as $row) {
      echo "<tr>";
      for ($i = 0; $i < 20; $i++) {
        $value = isset($row[$i]) ? $row[$i] : '';
        echo "<td data-label='{$columns[$i]}'>{$value}</td>";
      }
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
