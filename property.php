<?php

class property extends database
{

    protected function getAllProperties($id, $type, $saleType, $minPrice, $maxPrice, $city, $nh, $rooms, $minSpace, $maxSpace, $minYear, $maxYear, $exclusive, $sort, $keywords, $showPage, $includeLimit)
    {
        $orderBy = '';
        switch ($sort) {
            case 0:
                $orderBy = 'ORDER BY id DESC';
                break;
            case 1:
                $orderBy = 'ORDER BY price DESC';
                break;
            case 2:
                $orderBy = 'ORDER BY price ASC';
                break;
            case 3:
                $orderBy = 'ORDER BY year ASC';
                break;
            case 4:
                $orderBy = 'ORDER BY year DESC';
                break;
            case 5:
                $orderBy = 'ORDER BY space ASC';
                break;
            case 6:
                $orderBy = 'ORDER BY space DESC';
                break;
            default:
                $orderBy = 'ORDER BY id DESC';
                break;
        }

        $whereClauses = [];
        $params = [];

        if ($type != null && $type != 0) {
            if ($type == 3) {
                $whereClauses[] = "(type = 4 OR type = 5)";
            } else {
                $whereClauses[] = "type = ?";
                $params[] = $type;
            }
        }

        if ($saleType != null && $saleType != 0) {
            $whereClauses[] = "saleType = ?";
            $params[] = $saleType;
        }

        if ($minPrice != null && $maxPrice != null) {
            $whereClauses[] = "price BETWEEN ? AND ?";
            $params[] = $minPrice;
            $params[] = $maxPrice;
        } elseif ($minPrice != null && $maxPrice == null) {
            $whereClauses[] = "price >= ?";
            $params[] = $minPrice;
        } elseif ($minPrice == null && $maxPrice != null) {
            $whereClauses[] = "price <= ?";
            $params[] = $maxPrice;
        }

        if ($city != null) {
            $whereClauses[] = "city = ?";
            $params[] = $city;
        }

        if ($nh != null) {
            $whereClauses[] = "nh = ?";
            $params[] = $nh;
        }

        if ($rooms != null) {
            $whereClauses[] = "rooms = ?";
            $params[] = $rooms;
        }

        if ($minSpace != null && $maxSpace != null) {
            $whereClauses[] = "space BETWEEN ? AND ?";
            $params[] = $minSpace;
            $params[] = $maxSpace;
        } elseif ($minSpace != null && $maxSpace == null) {
            $whereClauses[] = "space >= ?";
            $params[] = $minSpace;
        } elseif ($minSpace == null && $maxSpace != null) {
            $whereClauses[] = "space <= ?";
            $params[] = $maxSpace;
        }

        if ($minYear != null && $maxYear != null) {
            $whereClauses[] = "year BETWEEN ? AND ?";
            $params[] = $minYear;
            $params[] = $maxYear;
        }

        if ($exclusive != null) {
            $whereClauses[] = "exclusive = ?";
            $params[] = $exclusive;
        }


        if ($includeLimit == 0) {
            $pageShow = ($showPage - 1) * 4;
            $finnish = $pageShow + 3;
            $limit = "LIMIT " . $pageShow . ", 4";
        } else {
            $limit = '';
        }

        if ($keywords !== null) {
            $keywordList = explode(',', $keywords);  // Split keywords into an array
            $keywordClauses = [];

            foreach ($keywordList as $keyword) {
                $keyword = trim($keyword);
                if ($keyword !== '') {
                    $keywordClauses[] = "description LIKE ?";
                    $params[] = "%" . $keyword . "%";
                }
            }

            if (!empty($keywordClauses)) {
                $whereClauses[] = '(' . implode(' OR ', $keywordClauses) . ')';
            }
        }

        if ($id != null) {
            $sql = "SELECT * FROM property WHERE id = ?";
            $params = [$id];

            try {

                $result = $this->connect()->prepare($sql);
                $result->execute($params);
                if ($result->rowCount() > 0) {
                    return $result;
                } else {
                    $whereClause = !empty($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

                    $sql = "SELECT * FROM property " . $whereClause . " " . $orderBy . " " . $limit;

                    $result = $this->connect()->prepare($sql);
                    $result->execute($params);

                    return $result;
                }
            } catch (PDOException $e) {
            }
        } else {
            $whereClause = !empty($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

            $sql = "SELECT * FROM property " . $whereClause . " " . $orderBy . " " . $limit;
            $result = $this->connect()->prepare($sql);
            $result->execute($params);
            return $result;
        }
    }

    protected function lastSix()
    {
        $sql = "SELECT * FROM property ORDER BY id DESC LIMIT 0, 6 ";

        $result = $this->connect()->prepare($sql);
        $result->execute();

        return $result;
    }

    protected function getProperyDetails($id)
    {
        $sql = "SELECT * FROM property WHERE id = ?";

        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);

        return $result;
    }

    protected function getSpecs($id)
    {
        $sql = "SELECT name FROM specs WHERE property = ?";

        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);

        return $result;
    }

    protected function getAllFromImages($id)
    {
        $sql = "SELECT imageName FROM images WHERE main = 1 AND property = ?";

        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);

        return $result;
    }

    protected function getImages($id)
    {
        $sql = "SELECT imageName FROM images WHERE property = ?";

        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);

        return $result;
    }

    protected function getZone($id)
    {
        $sql = "SELECT name FROM zone WHERE id = ?";

        $run = $this->connect()->prepare($sql);
        $run->execute([$id]);
        $result = $run->fetch();

        return $result;
    }

    protected function getPrimaryImage($id)
    {
        $sql = "SELECT imageName FROM images WHERE property = ? AND main = 1";

        $run = $this->connect()->prepare($sql);
        $run->execute([$id]);
        $result = $run->fetch();

        return $result;
    }

    protected function getCity($id)
    {
        $sql = "SELECT city FROM cities WHERE id = ?";

        $run = $this->connect()->prepare($sql);
        $run->execute([$id]);
        $result = $run->fetch();

        return $result;
    }

    protected function getAllCities()
    {
        $sql = "SELECT * FROM cities";

        $result = $this->connect()->prepare($sql);
        $result->execute([]);

        return $result;
    }

    protected function getAllNH($city)
    {
        $sql = "SELECT * FROM zone WHERE city = ?";

        $result = $this->connect()->prepare($sql);
        $result->execute([$city]);

        return $result;
    }
}
