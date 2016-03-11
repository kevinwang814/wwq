<?php
class Ext_Sphinx
{
    private $_sphinx = null;

    public function  __construct()
    {
        include_once FW_PATH.'/util/sphinxapi.php';
        $this->_sphinx = new SphinxClient();
        $this->setServer(C('sphinx_host'), 9312);
        $this->setMatchMode(SPH_MATCH_EXTENDED2);
        $this->_sphinx->SetLimits(0, 1000, 1000);
    }
    
    public function setServer($address, $port)
    {
        $this->_sphinx->SetServer($address, $port);
    }
    
    public function setMatchMode($mode)
    {
        $this->_sphinx->SetMatchMode($mode);
    }
    
    public function setSortMode($mode = SPH_SORT_ATTR_DESC, $sortby = '')
    {
        $this->_sphinx->SetSortMode($mode, $sortby);
    }

    /*public function setLimits($page = 1, $limit = 20)
    {
        $offset = ($page - 1) * $limit;
        $this->_sphinx->SetLimits($offset, $limit, 1000);
    }*/
    
    public function setLimits($start = 0, $limit = 20)
    {
        $this->_sphinx->SetLimits($start, $limit, 1000);
    }
    
    public function setFilter($attribute, $values, $exclude=false)
    {
        if(!is_array($values))
        {
            $values = array($values);
        }
        $this->_sphinx->SetFilter($attribute, $values, $exclude);
    }
    
    public function setFilterFloatRange($attribute, $min, $max, $exclude=false)
    {
        $this->_sphinx->SetFilterFloatRange($attribute, $min, $max, $exclude=false);
    }

    public function setGroupBy($attribute, $func, $groupsort="@group desc")
    {
        $this->_sphinx->SetGroupBy($attribute, $func, $groupsort);
    }
    
    public function setGroupDistinct($attribute)
    {
        $this->_sphinx->SetGroupDistinct($attribute);
    }

    public function resetFilters()
    {
        $this->_sphinx->ResetFilters();
    }
    
    public function resetGroupBy()
    {
        $this->_sphinx->ResetGroupBy();
    }
    
    public function setArrayResult($arrayresult)
    {
        $this->_sphinx->SetArrayResult($arrayresult);
    }
    
    public function formatKeyword($kw)
    {
        $kw = trim($kw);
        $kw = str_replace("　", " ", $kw);
        $kw = urldecode($kw);
        $arrayKw = explode(" ", $kw);
        $kw = '"' . implode('" "', $arrayKw) . '"';
        return $kw;
    }
    
    public function buildExcerpts(&$data, $kw, $index, $field)
    {
        $opts = array(
            "before_match" => "<em class='highline'>",
            "after_match" => "</em>",
            'exact_phrase' => true
        );

        $contents = array();
        foreach($data as $item)
        {
            //$item = trim(strip_tags($item[$field]));
            //$contents[] = preg_replace("/\s+/", "", $item);
            $contents[] = $item[$field];
        }

        $contents = $this->_sphinx->BuildExcerpts($contents, $index, $kw, $opts);

        foreach($data as $k => &$v)
        {
            $v[$field] = $contents[$k];
        }
        return $data;
    }
    
    public function query($kw, $index)
    {
        return $this->_sphinx->Query($kw,$index);
    }
}
?>
