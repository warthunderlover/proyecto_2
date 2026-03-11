<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER sync_insert_productos_to_producto
            AFTER INSERT ON productos
            FOR EACH ROW
            BEGIN
                IF @syncing IS NULL THEN
                    SET @syncing = 1;
                    INSERT INTO producto (id_producto, nombre_producto, estado_producto, precio_compra, cantidad_stock, created_at, updated_at)
                    VALUES (NEW.id, NEW.nombre, IF(NEW.estado = "activo", 1, 0), NEW.precio, NEW.stock, NEW.created_at, NEW.updated_at);
                    SET @syncing = NULL;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER sync_update_productos_to_producto
            AFTER UPDATE ON productos
            FOR EACH ROW
            BEGIN
                IF @syncing IS NULL THEN
                    SET @syncing = 1;
                    UPDATE producto SET
                        nombre_producto = NEW.nombre,
                        estado_producto = IF(NEW.estado = "activo", 1, 0),
                        precio_compra   = NEW.precio,
                        cantidad_stock  = NEW.stock,
                        updated_at      = NEW.updated_at
                    WHERE id_producto = NEW.id;
                    SET @syncing = NULL;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER sync_insert_producto_to_productos
            AFTER INSERT ON producto
            FOR EACH ROW
            BEGIN
                IF @syncing IS NULL THEN
                    SET @syncing = 1;
                    INSERT INTO productos (id, nombre, stock, precio, estado, created_at, updated_at)
                    VALUES (NEW.id_producto, NEW.nombre_producto, NEW.cantidad_stock, NEW.precio_compra, IF(NEW.estado_producto = 1, "activo", "inactivo"), NEW.created_at, NEW.updated_at);
                    SET @syncing = NULL;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER sync_update_producto_to_productos
            AFTER UPDATE ON producto
            FOR EACH ROW
            BEGIN
                IF @syncing IS NULL THEN
                    SET @syncing = 1;
                    UPDATE productos SET
                        nombre     = NEW.nombre_producto,
                        stock      = NEW.cantidad_stock,
                        precio     = NEW.precio_compra,
                        estado     = IF(NEW.estado_producto = 1, "activo", "inactivo"),
                        updated_at = NEW.updated_at
                    WHERE id = NEW.id_producto;
                    SET @syncing = NULL;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER actualizar_stock_after_insert_producto
            AFTER INSERT ON detalle_compras
            FOR EACH ROW
            BEGIN
                UPDATE producto
                SET cantidad_stock = cantidad_stock - NEW.cantidad
                WHERE id_producto = NEW.id_producto;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS sync_insert_productos_to_producto');
        DB::unprepared('DROP TRIGGER IF EXISTS sync_update_productos_to_producto');
        DB::unprepared('DROP TRIGGER IF EXISTS sync_insert_producto_to_productos');
        DB::unprepared('DROP TRIGGER IF EXISTS sync_update_producto_to_productos');
        DB::unprepared('DROP TRIGGER IF EXISTS actualizar_stock_after_insert_producto');
    }
};