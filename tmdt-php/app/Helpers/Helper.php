<?php


namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }
        return $html;
    }

    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }

    public static function menus($menus, $parent_id = 0) :string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . '
                        </a>';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }
    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

    public static function price($price = 0, $priceSale = 0) {
        $currency = 'VND'; // Đơn vị tiền tệ

    if ($priceSale != 0 ) {
            // Tính tỷ lệ phần trăm giảm giá
            $percentage = round((($price - $priceSale) / $price) * 100);
            // Định dạng giá khuyến mại
            $priceSale = '<span class="price-sale" style="color: rgb(20, 53, 195);">' . number_format($priceSale) . " " . $currency . '</span>';
            $priceSale = '<b>' . $priceSale . '</b>'; // In đậm giá gốc
            
            // Định dạng giá gốc với gạch ngang 
            $price = '<span class="price-original">' . number_format($price) . " " . $currency . '</span>';
            $price = '<del>' . $price . '</del>'; // Gạch ngang giá gốc

            // Hiển thị giá khuyến mại, giá gốc và phần trăm giảm giá trong cùng một dòng
            return $priceSale . ' <br> ' . $price . ' (-' . $percentage . '%)';       
    } else if ($price != 0) {
        // Hiển thị giá gốc nếu không có giá giảm
        return number_format($price) . ' ' . $currency;
    } else {
        // Hiển thị liên hệ nếu không có giá
        return '<a href="/contact">Liên Hệ</a>';
    }
    }
}