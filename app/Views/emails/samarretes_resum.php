<?php
/**
 * Correu HTML amb el resum d'una comanda de samarretes.
 *
 * @var array<string, mixed>  $comanda  Fila de tsamarretes
 * @var \Config\Samarretes    $config
 * @var bool                  $perAvis  true = correu intern a l'organització
 */
$euros = static fn (float $v): string => number_format($v, 2, ',', '.') . ' €';
$unitats = 0;
?>
<!doctype html>
<html lang="ca">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="margin:0;padding:0;background:#f4f4f5;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5;padding:24px 12px;">
<tr><td align="center">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background:#ffffff;border-radius:8px;overflow:hidden;">
    <tr><td style="background:#b91c1c;color:#ffffff;padding:20px 24px;font-size:20px;font-weight:bold;">
        Cremem pels Xuklis · Samarretes
    </td></tr>
    <tr><td style="padding:24px;font-size:15px;line-height:1.5;">
        <?php if ($perAvis): ?>
            <p style="margin:0 0 16px;">S'ha rebut una <strong>comanda nova de samarretes</strong> (núm. <?= (int) $comanda['id'] ?>).</p>
        <?php else: ?>
            <p style="margin:0 0 16px;">Hola <?= esc($comanda['nom']) ?>,</p>
            <p style="margin:0 0 16px;">Gràcies per la teva comanda. Aquest és el resum del que has demanat:</p>
        <?php endif ?>

        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin:0 0 20px;font-size:14px;">
            <tr><td style="padding:4px 0;color:#6b7280;width:40%;">Nom entitat/persona</td><td style="padding:4px 0;"><?= esc($comanda['nom']) ?></td></tr>
            <tr><td style="padding:4px 0;color:#6b7280;">Correu electrònic</td><td style="padding:4px 0;"><?= esc($comanda['email']) ?></td></tr>
            <tr><td style="padding:4px 0;color:#6b7280;">Telèfon</td><td style="padding:4px 0;"><?= esc($comanda['telefon']) ?></td></tr>
            <tr><td style="padding:4px 0;color:#6b7280;">Núm. de comanda</td><td style="padding:4px 0;"><?= (int) $comanda['id'] ?></td></tr>
        </table>

        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:14px;margin:0 0 20px;">
            <tr style="background:#f3f4f6;">
                <th align="left"  style="padding:8px;border-bottom:1px solid #e5e7eb;">Talla</th>
                <th align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;">Quantitat</th>
                <th align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;">Preu unitari</th>
                <th align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;">Import</th>
            </tr>
            <?php foreach ($config->grups as $titol => $talles): ?>
                <?php foreach ($talles as $clau => $etiqueta):
                    $q = (int) ($comanda[$config->columna($clau)] ?? 0);
                    if ($q === 0) {
                        continue;
                    }
                    $unitats += $q;
                ?>
                <tr>
                    <td style="padding:8px;border-bottom:1px solid #e5e7eb;"><?= esc($etiqueta) ?> <span style="color:#6b7280;font-size:12px;">(<?= esc(mb_strtolower($titol)) ?>)</span></td>
                    <td align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;"><?= $q ?></td>
                    <td align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;white-space:nowrap;"><?= $euros($config->preuUnitari) ?></td>
                    <td align="right" style="padding:8px;border-bottom:1px solid #e5e7eb;white-space:nowrap;"><?= $euros($q * $config->preuUnitari) ?></td>
                </tr>
                <?php endforeach ?>
            <?php endforeach ?>
            <tr>
                <td style="padding:10px 8px;font-weight:bold;">Total</td>
                <td align="right" style="padding:10px 8px;font-weight:bold;"><?= $unitats ?></td>
                <td></td>
                <td align="right" style="padding:10px 8px;font-weight:bold;white-space:nowrap;"><?= $euros((float) $comanda['total']) ?></td>
            </tr>
        </table>

        <p style="margin:0 0 16px;padding:12px 16px;background:#fef2f2;border-left:4px solid #b91c1c;">
            Properament ens posarem en contacte <?= $perAvis ? 'amb ' . esc($comanda['nom']) : 'amb tu' ?>
            per informar de les condicions de pagament.
        </p>

        <?php if (! $perAvis): ?>
            <p style="margin:0;">Diables de Barcelona</p>
        <?php endif ?>
    </td></tr>
</table>
</td></tr>
</table>
</body>
</html>
