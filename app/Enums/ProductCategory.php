<?php

namespace App\Enums;

enum ProductCategory: string
{
    case LISTRIK_ELECTRICAL = 'Listrik & Electrical';
    case ALAT_BERAT_DUMP_TRUCK = 'Alat Berat & Dump Truck';
    case CONSUMABLE_GOODS = 'Consumable Goods';
    case GASKET_FASTENER = 'Gasket & Fastener';
    case AIR_CONDITIONER = 'Air Conditioner';
    case POWER_TOOLS_HAND_TOOLS = 'Power Tools & Hand Tools';
    case LAINNYA = 'Lainnya';

    /**
     * Get all category values as array.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Determine category based on product name keywords.
     */
    public static function matchCategoryByName(string $name): string
    {
        $name = trim($name);

        // 1. Air Conditioner: 'AC', 'Freon', 'Air Conditioner'
        if (preg_match('/\b(Standing\s+AC|Air\s+Conditioner|Freon)\b/i', $name) || preg_match('/\bAC\b/i', $name)) {
            return self::AIR_CONDITIONER->value;
        }

        // 2. Gasket & Fastener: 'Gasket', 'Packing', 'Baut', 'Nut', 'Bolt'
        if (preg_match('/\b(Gasket|Packing|Baut|Nut|Bolt)\b/i', $name)) {
            return self::GASKET_FASTENER->value;
        }

        // 3. Power Tools & Hand Tools: 'Bor', 'Impact', 'Wrench', 'Tools', 'Gerinda', 'Drill'
        // Ground Engaging Tools is heavy equipment component
        if (preg_match('/\bGround\s+Engaging\b/i', $name)) {
            return self::ALAT_BERAT_DUMP_TRUCK->value;
        }
        if (preg_match('/\b(Bor|Impact|Wrench|Tools|Gerinda|Drill)\b/i', $name)) {
            return self::POWER_TOOLS_HAND_TOOLS->value;
        }

        // 4. Listrik & Electrical: 'Kabel', 'Supreme', 'Eterna', 'Lamp', 'Baterai', 'Battery', 'Electrical', 'Listrik', 'Cable'
        if (preg_match('/\b(Kabel|Lamp|Baterai|Battery|Electrical|Listrik|Cable)\b/i', $name)) {
            return self::LISTRIK_ELECTRICAL->value;
        }

        // 5. Consumable Goods: 'WD-40', 'Grease', 'Pelumas', 'Sealant', 'Lem', 'Solvent'
        if (preg_match('/\b(WD-?40|Grease|Pelumas|Sealant|Lem|Solvent)\b/i', $name)) {
            return self::CONSUMABLE_GOODS->value;
        }

        // 6. Alat Berat & Dump Truck:
        // 'Hino', 'Forklift', 'Tyre', 'Sprocket', 'Roller', 'Track', 'Filter', 'Oil', 'Steering',
        // 'Idler', 'Segment', 'Cylinder', 'Bucket', 'Kopling', 'Pinion', 'Engkol', 'Turbocharger', 'Water Pump', 'Alternator'
        if (preg_match('/\b(Hino|Forklift|Tyre|Sprocket|Roller|Track|Filter|Oil|Oli|Steering|Idler|Segment|Cylinder|Bucket|Kopling|Pinion|Engkol|Turbocharger|Water\s+Pump|Alternator|Dump\s*Truck)\b/i', $name)) {
            return self::ALAT_BERAT_DUMP_TRUCK->value;
        }

        // 7. Fallback / Lainnya
        return self::LAINNYA->value;
    }
}
