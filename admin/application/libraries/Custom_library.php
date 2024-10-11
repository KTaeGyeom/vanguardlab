<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_library {

  protected $CI;
  

  // We'll use a constructor, as you can't directly call a function from a property definition.
  public function __construct() {
    // Assign the CodeIgniter super-object
    $this->CI =& get_instance();
  }

  
  // 법인별, 쿼리별 where 조건 추가
  function appendCondition($branch_code, $name, $sql, $storageType, $workCycle, $param1 = '')	{

    //$this->print_message('DEBUG', 'appendCondition param. $branch_code:' . $branch_code . ',$name:' . $name . ',$storageType:' . $storageType . ',$param1:' . $param1);

    $baseDate = date("Ymd", strtotime("-1 day", strtotime($param1)));

    switch ($branch_code) {

      // 러시아 법인
      case '1054':

        $strWhere = $sql . " WHERE ";
        switch ($workCycle) {
          case 'daily':
            $workCycle1 = 'D';
            break;
          case 'monthly':
            $workCycle1 = 'M';
            break;
          default:
        }

        //특정 테이블일때는 조건이 변경
        switch ($name) {
          case 'CFT_vw_crit_docum_rc_swift':
            $strWhere .= "((c_36 > LAST_DAY('" . $baseDate . "' - INTERVAL 1 MONTH) AND c_36 <= LAST_DAY('" . $baseDate."')) OR (c_10 > LAST_DAY('" . $baseDate . "' - INTERVAL 1 MONTH) AND c_10 <= LAST_DAY('" . $baseDate . "'))) AND c_2 = '103'";
            break;

          case 'kebhnbinfo_table_cnt':
            $strWhere .= "basc_dt = '" . $baseDate . "' AND job_cyc = '" . $workCycle1 . "'";
            break;

          default:
            //변동(change or 전체(full)에 따라 쿼리 변경
            //변동인 경우 입력받은 작업날짜에 해당하면서 flag가 비어있지 않은 레코드(C(Create), U(Update), D(Delete) 전부 다 가져오기, 비어있다면 아무런 이벤트가 발생하지 않음)
            if ($storageType == 'change') {
              $strWhere .= "keb_date = '" . $baseDate . "' AND keb_flag <> ''";
            }
            //전체인 경우 삭제된 데이터만 제외한 레코드
            else {
              $strWhere .= "keb_flag <> 'D'";
            }
            break;
        }
        break;

      // 브라질 법인
      case '1058': 

        $strWhere = "";

        //특정 테이블일때는 조건이 변경
        switch ($name) {
          default:
            $strWhere .= $sql;
            break;
        }
        break;

      // 기타 법인
      default:
        $strWhere .= $sql;
        break;
    }
    
    return $strWhere;
  }


  // Post Export 작업 (법인별)
  function postExport($expDb, $branch_code, $tableName, $workCycle, $param1)	{

    $baseDate = date("Ymd", strtotime("-1 day", strtotime($param1)));

    switch ($branch_code) {

      // 러시아 법인
      case '1054':
        switch ($workCycle) {
          case 'daily':
            $workCycle1 = 'D';
            break;
          case 'monthly':
            $workCycle1 = 'M';
            break;
          default:
        }

        // Table count
        if ($tableName != 'kebhnbinfo_table_cnt') {
          $expDb->query("CALL pr_table_cnt('" . $baseDate . "','" . $tableName . "','" . $workCycle1 . "');");
        }
        break;
        
      default:
    }
  }

}