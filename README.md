# IIC2413_Proyecto
Stefano Cando y Esteban Reyes

Entrega 1: <br /> 
Copie los siguientes comandos para realizar las consultas de forma más rápida ;) <br />
Consulta 1: <br />
SELECT dir FROM Unidades;  <br />
Consulta 2: <br />
SELECT Vehiculos.* FROM Vehiculos, Flota WHERE Vehiculos.vid = Flota.vid AND Flota.uid IN (SELECT Unidades.uid FROM Unidades, DirEn WHERE Unidades.dir = DirEn.dir AND DirEn.cid IN (SELECT Comunas.cid FROM Comunas WHERE Comunas.cnombre = 'San Joaquin')); <br />
Consulta 3: <br />
SELECT Vehiculos.* FROM Vehiculos WHERE Vehiculos.vid IN (SELECT Despachos.vid FROM Despachos, DirEn WHERE Despachos.dirdestino = DirEn.dir AND Despachos.fecha >= '2021-01-01' AND Despachos.fecha < '2022-01-01' AND DirEn.cid IN (SELECT Comunas.cid FROM Comunas WHERE Comunas.cnombre = 'Valparaiso')); <br />
 
