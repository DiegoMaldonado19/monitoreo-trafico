-- 1. Cantidad total de vehículos por tipo en un rango de fechas
SELECT tv.nombre_tipo_vehiculo, SUM(fvd.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_detalle fvd
JOIN tipo_vehiculo tv ON fvd.id_tipo_vehiculo = tv.id_tipo_vehiculo
JOIN flujo_vehicular fv ON fvd.id_flujo = fv.id_flujo
WHERE fv.fecha_hora BETWEEN '2023-01-01' AND '2023-12-31'
GROUP BY tv.nombre_tipo_vehiculo;

-- 2. Velocidad promedio de los vehículos por tipo en una intersección específica
SELECT tv.nombre_tipo_vehiculo, AVG(fv.velocidad_promedio) AS velocidad_promedio
FROM flujo_vehicular fv
JOIN flujo_vehicular_detalle fvd ON fv.id_flujo = fvd.id_flujo
JOIN tipo_vehiculo tv ON fvd.id_tipo_vehiculo = tv.id_tipo_vehiculo
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
JOIN calle c ON s.id_calle = c.id_calle
WHERE c.nombre_calle = 'Calle Principal'
GROUP BY tv.nombre_tipo_vehiculo;

-- 3. Tiempo promedio de espera en los semáforos por calle
SELECT c.nombre_calle, AVG(s.tiempo_rojo) AS tiempo_promedio_rojo
FROM semaforo s
JOIN calle c ON s.id_calle = c.id_calle
GROUP BY c.nombre_calle;

-- 4. Cantidad de pruebas realizadas por cada monitor
SELECT u.nombre_usuario, COUNT(p.id_prueba) AS total_pruebas
FROM prueba p
JOIN usuario u ON p.id_usuario = u.id_usuario
JOIN rol r ON u.id_rol = r.id_rol
WHERE r.nombre_rol = 'Monitor'
GROUP BY u.nombre_usuario;

-- 5. Flujo vehicular total por semáforo en un día específico
SELECT s.id_semaforo, SUM(fvd.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_detalle fvd
JOIN flujo_vehicular fv ON fvd.id_flujo = fv.id_flujo
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
WHERE DATE(fv.fecha_hora) = '2023-10-01'
GROUP BY s.id_semaforo;

-- 6. Cantidad de vehículos por tipo en una prueba específica
SELECT tv.nombre_tipo_vehiculo, SUM(fvp.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_prueba_detalle fvp
JOIN tipo_vehiculo tv ON fvp.id_tipo_vehiculo = tv.id_tipo_vehiculo
WHERE fvp.id_flujo_prueba = 1
GROUP BY tv.nombre_tipo_vehiculo;

-- 7. Tiempo total invertido en pruebas por cada monitor
SELECT u.nombre_usuario, SUM(TIMESTAMPDIFF(MINUTE, p.fecha_hora_inicio, p.fecha_hora_fin)) AS tiempo_total_minutos
FROM prueba p
JOIN usuario u ON p.id_usuario = u.id_usuario
JOIN rol r ON u.id_rol = r.id_rol
WHERE r.nombre_rol = 'Monitor'
GROUP BY u.nombre_usuario;

-- 8. Cantidad de vehículos que pasaron por un semáforo en estado rojo
SELECT s.id_semaforo, SUM(fvd.cantidad_vehiculos) AS total_vehiculos_rojo
FROM flujo_vehicular_detalle fvd
JOIN flujo_vehicular fv ON fvd.id_flujo = fv.id_flujo
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
WHERE s.tiempo_rojo > 0
GROUP BY s.id_semaforo;

-- 9. Reporte de pruebas realizadas con observaciones
SELECT p.id_prueba, u.nombre_usuario, p.fecha_hora_inicio, p.fecha_hora_fin, p.observaciones
FROM prueba p
JOIN usuario u ON p.id_usuario = u.id_usuario
WHERE p.observaciones IS NOT NULL;

-- 10. Cantidad de vehículos por tipo en una avenida específica
SELECT tv.nombre_tipo_vehiculo, SUM(fvd.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_detalle fvd
JOIN flujo_vehicular fv ON fvd.id_flujo = fv.id_flujo
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
JOIN calle c ON s.id_calle = c.id_calle
JOIN tipo_calle tc ON c.id_tipo_calle = tc.id_tipo_calle
JOIN tipo_vehiculo tv ON fvd.id_tipo_vehiculo = tv.id_tipo_vehiculo
WHERE tc.nombre_tipo_calle = 'Avenida'
GROUP BY tv.nombre_tipo_vehiculo;

-- 11. Semáforos con mayor flujo vehicular en una hora pico
SELECT s.id_semaforo, SUM(fvd.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_detalle fvd
JOIN flujo_vehicular fv ON fvd.id_flujo = fv.id_flujo
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
WHERE HOUR(fv.fecha_hora) = 18
GROUP BY s.id_semaforo
ORDER BY total_vehiculos DESC
LIMIT 5;

-- 12. Cantidad de pruebas realizadas por tipo de prueba
SELECT tp.nombre_tipo_prueba, COUNT(p.id_prueba) AS total_pruebas
FROM prueba p
JOIN tipo_prueba tp ON p.id_tipo_prueba = tp.id_tipo_prueba
GROUP BY tp.nombre_tipo_prueba;

-- 13. Velocidad promedio de los vehículos en una calle específica
SELECT c.nombre_calle, AVG(fv.velocidad_promedio) AS velocidad_promedio
FROM flujo_vehicular fv
JOIN semaforo s ON fv.id_semaforo = s.id_semaforo
JOIN calle c ON s.id_calle = c.id_calle
WHERE c.nombre_calle = 'Calle Secundaria'
GROUP BY c.nombre_calle;

-- 14. Cantidad de vehículos por tipo en una prueba específica
SELECT tv.nombre_tipo_vehiculo, SUM(fvp.cantidad_vehiculos) AS total_vehiculos
FROM flujo_vehicular_prueba_detalle fvp
JOIN tipo_vehiculo tv ON fvp.id_tipo_vehiculo = tv.id_tipo_vehiculo
WHERE fvp.id_flujo_prueba = 1
GROUP BY tv.nombre_tipo_vehiculo;

-- 15. Reporte de pruebas realizadas por un supervisor
SELECT p.id_prueba, u.nombre_usuario, p.fecha_hora_inicio, p.fecha_hora_fin, tp.nombre_tipo_prueba
FROM prueba p
JOIN usuario u ON p.id_usuario = u.id_usuario
JOIN tipo_prueba tp ON p.id_tipo_prueba = tp.id_tipo_prueba
JOIN rol r ON u.id_rol = r.id_rol
WHERE r.nombre_rol = 'Supervisor';